<?php

class Condorcet_Vote
{
	public $_bean ;
	public $_objectCondorcet ;
	protected $_isNew = false ;
	protected $_checksum_change = false ;

	public function __construct ($vote, $title = null, $methods = null, $description = null)
	{		
		if (is_object($vote))
		{
			$this->register($vote, $title, $methods, $description);
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

		R::store($this->_bean);
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

	protected function register (Condorcet\Condorcet $vote, $title, $methods, $description)
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

		$this->_bean->read_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(4, $true)));
		$this->_bean->admin_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(4, $true)));

		$this->_bean->hash_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(4, $true)));
		$this->_bean->open = true ;

		$this->_objectCondorcet = $vote ;
		$this->_bean->condorcet_version = $this->_objectCondorcet->getObjectVersion();

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
			{ throw new Exception ('Impossible de charger le vote'); }
		else
		{
			$this->_objectCondorcet = unserialize($this->_bean->condorcet_object) ;
			$this->prepareCondorcet();
		}
	}

	protected function saveVotesList ()
	{
		$this->_bean->votes_list = serialize($this->_objectCondorcet->getVotesList());
	}

	public function update_methods ($methods, $prepare = true)
	{
		if (!is_array($methods) || count($methods) > 12)
			{ return false ;}

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

	protected function prepareCondorcet ()
	{
		$this->_objectCondorcet->getWinner();

		foreach (unserialize($this->_bean->methods) as $method)
		{
			$this->_objectCondorcet->getResult($method);
			$this->_objectCondorcet->getResultStats($method);
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

	public function getPublicURL ()
	{
		return BASE_URL . 'Vote/' . $this->_bean->read_code . '/' ;
	}

	public function getAdminURL ()
	{
		return BASE_URL . 'Edit/' . $this->_bean->read_code . '/' . $this->getAdminCode() . '/' ;
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
		return BASE_URL . 'Add/' . $this->_bean->read_code . '/Public/' . $this->getFreeVoteCode() . '/' ;
	}

		public function getFreeVoteCode ()
		{
			return substr(hash('sha224', $this->_bean->admin_code . $this->_bean->hash_code), 5,7) ; ;
		}

	public function getPersonnalVoteBaseUrl ()
	{
		return BASE_URL . 'Add/' . $this->_bean->read_code . '/Personnal/';
	}
}