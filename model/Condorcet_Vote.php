<?php

use RedBeanPHP\R;

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
				$this->writeVoteObject();
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

	protected function register (CondorcetPHP\Condorcet\Election $vote, $title, $methods, $description = null, $open)
	{
		$this->_isNew = true ;

		$this->_bean = R::dispense( 'condorcet' );

		$this->_bean->title = $title;
		$this->_bean->description = (empty($description)) ? null : $description;

		$this->_bean->methods = serialize(array()) ;
		$this->update_methods($methods, false);

		$this->_bean->date = R::isoDateTime();
		$this->_bean->last_update = $this->_bean->date;
		$this->_bean->count_update = 0;

		$this->_bean->read_code = strtoupper(bin2hex(random_bytes(5)));
		$this->_bean->admin_code = strtoupper(bin2hex(random_bytes(5)));

		$this->setOpen(true);

		$this->_objectCondorcet = $vote ;
		$this->_bean->condorcet_version = '-'.$this->_objectCondorcet->getObjectVersion('MAJOR');

		$this->_bean->candidates = serialize($this->_objectCondorcet->getCandidatesList(true));
		$this->saveVotesList();

		$this->prepareCondorcet();
		$this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
		$this->writeVoteObject();
	}

	protected function load ($read_code)
	{
		$this->_bean = R::findOne( 'condorcet', ' read_code = ? ', [ $read_code ]);

		if (is_null($this->_bean))
			{ throw new Exception ('Vote inexistant'); }
		else
		{
			try	{
				if ( $this->_bean->condorcet_version !== "-".CondorcetPHP\Condorcet\Condorcet::getVersion('MAJOR') )
					{ throw new CondorcetPHP\Condorcet\Throwable\ElectionObjectVersionMismatchException(); }
				$this->_objectCondorcet = $this->getVoteObject() ;
				$this->prepareCondorcet();
			}
			catch (CondorcetPHP\Condorcet\Throwable\ElectionObjectVersionMismatchException $e) {

			// Update de l'objet & reconstruction
				$this->_objectCondorcet = new CondorcetPHP\Condorcet\Election () ;

				// Reconstruction

					// Candidats
					$this->_objectCondorcet->addCandidatesFromJson(json_encode(unserialize($this->_bean->candidates)));

					// Votes
					foreach ( unserialize($this->_bean->votes_list) as $vote )
					{
						$tag = $vote['tag'];
						$timestamp = $vote['timestamp'];

						unset($vote['tag']);
						unset($vote['timestamp']);

						$this->_objectCondorcet->addVote(new CondorcetPHP\Condorcet\Vote ($vote, $tag, $timestamp));
					}

				// Mise à jour
				$this->_bean->condorcet_version = '-'.$this->_objectCondorcet->getObjectVersion('MAJOR');
				$this->saveVotesList();
				$this->prepareCondorcet();
				$this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
				$this->writeVoteObject();
			}

		}
	}

	protected function saveVotesList ()
	{
		$voteList = $this->_objectCondorcet->getVotesList();

		foreach ($voteList as &$oneVote) {
			$NewoneVote = $oneVote->getRanking();
			$NewoneVote['tag'] = $oneVote->getTags();
			$NewoneVote['timestamp'] = $oneVote->getTimestamp();

			$oneVote = $NewoneVote;
		}

		$this->_bean->votes_list = serialize(CondorcetPHP\Condorcet\CondorcetUtil::format($voteList,true));
	}

	public function update_methods ($methods, $prepare = true)
	{
		// Check

		if (!is_array($methods) || count($methods) > count(CONDORCET_METHOD))
			{ return false ;}

		$auth_methods = CONDORCET_METHOD;
		foreach ($methods as &$oneMethod)
		{
			if ($oneMethod == 'Dodgson') {
				$oneMethod = 'Dodgson Quick';
			}

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
		} catch (CondorcetPHP\Condorcet\Throwable\CondorcetPublicApiException $e) {}


		foreach (unserialize($this->_bean->methods) as $method)
		{
			try {
				if ($method !== 'Dodgson') {
					$this->_objectCondorcet->computeResult($method);
				}
			} catch (CondorcetPHP\Condorcet\Throwable\CandidatesMaxNumberReachedException | CondorcetPHP\Condorcet\Throwable\ResultRequestedWithoutVotesException $e) {
				Events::add( new EventsError(server_code: 500, private_details: $e) );
			}

		}
	}


		//////

	public function getTitle ()
	{
		return htmlspecialchars($this->_bean->title ?? '') ;
	}

	public function getDescription ()
	{
		return  htmlspecialchars($this->_bean->description ?? '') ;
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
		$this->_bean->hash_code = strtoupper(bin2hex(random_bytes(5)));
	}

	public function writeVoteObject () : void
	{
		file_put_contents($this->getSavedVoteObjectPath(), serialize($this->_objectCondorcet));
	}

	public function getVoteObject ()
	{
		return unserialize(file_get_contents($this->getSavedVoteObjectPath()));
	}

	public function getSavedVoteObjectPath () : string
	{
		return __DIR__.'/../cache/'.$this->_bean->read_code.'.election';
	}
}