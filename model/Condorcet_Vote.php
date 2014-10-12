<?php

class Condorcet_Vote
{
	public $_bean ;
	public $_objectCondorcet ;
	protected $_isNew = false ;
	protected $_checksum_change = false ;

	public function __construct ($vote, $title = null, $methods = null, $description = null, $open = true)
	{		
		if (is_object($vote))
		{
			$this->register($vote, $title, $methods, $description, $open);
		}
		else
		{
			return $this->load($vote);
		}
	}

	public function __destruct ()
	{
		if	( $this->willUpdate() )
		{
			$this->_bean->last_update = R::isoDateTime();
			$this->_bean->count_update++ ;

			if ($this->_checksum_change)
			{
				$this->saveVotesList();
				$this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
				$this->_bean->condorcet_object = serialize($this->_objectCondorcet);
			}
		}

		// Enregistrement final conditionné à l'absence totale d'erreur
		if (!Events::isAnyError())
		{
			R::store($this->_bean);
		}
	}

		public function willUpdate ()
		{
			$this->_checksum_change = ($this->_bean->vote_checksum !== $this->_objectCondorcet->getChecksum()) ? true : false ;

			if	( 
					!$this->_isNew && (
					$this->_checksum_change
					||
					$this->_bean->hasChanged( 'methods' )
					||
					$this->_bean->hasChanged( 'description' )
					)			
				 )
					: return true ;
			else	: return false ;
			endif;
		}

	protected function register (Condorcet\Condorcet $vote, $title, $methods, $description = null, $open)
	{
		$true = true ;
		$this->_isNew = true ;

		$this->_bean = R::dispense( 'condorcet' );

		$this->_bean->title = $title;
		$this->_bean->description = (empty($description)) ? null : $description;

		$this->_bean->methods = serialize(array()) ;
		$this->update_methods($methods, false);

		$this->_bean->date = R::isoDateTime();
		$this->_bean->last_update = $this->_bean->date;
		$this->_bean->count_update = 0;

		$this->_bean->read_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(5, $true)));
		$this->_bean->admin_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(5, $true)));

		$this->setOpen(true);

		$this->_objectCondorcet = $vote ;
		$this->_bean->condorcet_version = '-'.$this->_objectCondorcet->getObjectVersion('MAJOR');

		$this->_bean->candidates = serialize($this->_objectCondorcet->getCandidatesList());
		$this->saveVotesList();

		$this->prepareCondorcet();
		$this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
		$this->_bean->condorcet_object = serialize($this->_objectCondorcet);
	}

	protected function load ($read_code)
	{
		$this->_bean = R::findOne( 'condorcet', ' read_code = ? ', [ $read_code ]);

		if (is_null($this->_bean))
			{ throw new Exception ('Vote inexistant'); }
		else
		{
			try	{
				$this->_objectCondorcet = unserialize($this->_bean->condorcet_object) ;
				$this->prepareCondorcet();
			}
			catch (Condorcet\CondorcetException $e) {

				// Update de l'objet & reconstruction
				if ($e->getCode() === 11)
				{
					$this->_objectCondorcet = new Condorcet\Condorcet () ;

					// Reconstruction

						// Candidats
						$this->_objectCondorcet->jsonCandidates(json_encode(unserialize($this->_bean->candidates)));
					
						// Votes
						foreach ( unserialize($this->_bean->votes_list) as $vote )
						{
							$tag = $vote['tag'];
							unset($vote['tag']);

							$this->_objectCondorcet->addVote($vote, $tag);
						}

					// Mise à jour
					$this->_bean->condorcet_version = '-'.$this->_objectCondorcet->getObjectVersion('MAJOR');
					$this->saveVotesList();
					$this->prepareCondorcet();
					$this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
					$this->_bean->condorcet_object = serialize($this->_objectCondorcet);
				}
				// Drôle d'erreur
				else
				{
					throw new Exception ('Impossible de reconstituer le vote');
				}
			}

		}
	}

	protected function saveVotesList ()
	{
		$this->_bean->votes_list = serialize($this->_objectCondorcet->getVotesList());
	}

	public function update_methods ($methods, $prepare = true)
	{
		// Check

		if (!is_array($methods) || count($methods) > 12)
			{ return false ;}

		$auth_methods = unserialize(CONDORCET_METHOD);
		foreach ($methods as $oneMethod)
		{
			if (!in_array($oneMethod, $auth_methods, true))
				{ return false ; }
		}

		$new_methods = serialize($methods) ;

		if ($new_methods !== $this->_bean->methods)
		{
			$this->_bean->methods = $new_methods;

			if ($prepare)
				{$this->prepareCondorcet();}

			return true ;
		}

		return false ;
	}

	public function prepareCondorcet ()
	{
		try {
			$this->_objectCondorcet->getWinner();
		} catch (Condorcet\CondorcetException $e) {}


		foreach (unserialize($this->_bean->methods) as $method)
		{
			try {
				$this->_objectCondorcet->computeResult($method);
			} catch (Condorcet\CondorcetException $e) {
				if ($e->getCode() !== 101 && $e->getCode() !== 6)
					{ Events::add( new Error(500) ); }
			}

		}
	}


		//////

	public function getTitle ()
	{
		return htmlspecialchars($this->_bean->title) ;
	}

	public function getDescription ()
	{
		return  htmlspecialchars($this->_bean->description) ;
	}

	public function getDate ()
	{
		return $this->_bean->date ;
	}

	public function getUpdateDate ()
	{
		return $this->_bean->last_update ;
	}

	public function getCountUpdate ()
	{
		return ($this->willUpdate()) ? $this->_bean->count_update + 1 : $this->_bean->count_update ;
	}

	public function isOpen ()
	{
		return $this->_bean->open ;
	}

	public function setOpen ($state)
	{
		if (!is_bool($state))
			{return false ;}
		else
		{
			if ($state && !$this->_bean->open)
			{
				$this->set_new_hashCode();
				$this->_bean->open = true ;
			}
			else
			{ $this->_bean->open = $state ; }
		}

		return $this->isOpen() ;
	}

	public function getPublicURL ()
	{
		return BASE_URL . 'Vote/' . $this->_bean->read_code . '/' ;
	}

	public function getAdminURL ()
	{
		return BASE_URL . 'Vote/' . $this->_bean->read_code . '/Admin/' . $this->getAdminCode() . '/' ;
	}

		public function getAdminCode ()
		{
			return $this->_bean->admin_code ;
		}

		public function getHashCode ()
		{
			return $this->_bean->hash_code ;
		}

	public function getFreeVoteUrl ()
	{
		return BASE_URL . 'Vote/' . $this->_bean->read_code . '/Public/' . $this->getFreeVoteCode() . '/' ;
	}

		public function getFreeVoteCode ()
		{
			return strtoupper(substr(hash('sha224', $this->_bean->admin_code . $this->_bean->hash_code), 5,8)) ;
		}

	public function getPersonnalVoteBaseUrl ()
	{
		return BASE_URL . 'Vote/' . $this->_bean->read_code . '/Personnal/';
	}

	public function getPersonnalVoteCode ($name)
	{
		return strtoupper( 
							substr(
								hash('sha224',
									$this->getAdminCode() . 
									$this->getHashCode() . 
									$name),
		 					10, 8) );
	}

	public function set_new_hashCode ()
	{
		$true = true ;
		$this->_bean->hash_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(5, $true)));
	}
}