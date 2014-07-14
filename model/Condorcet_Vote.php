<?php

class Condorcet_Vote
{
	protected $_load = true ;
	protected $_bean ;
	protected $_objectCondorcet ;
	protected $_originalChecksum ;

	public function __construct ($vote, $title = null)
	{		
		if (is_object($vote))
		{
			$this->register($vote, $title);
		}
		else
		{
			return $this->load($vote);
		}
	}

	public function __destruct ()
	{
		if ($this->_originalChecksum !== $this->_objectCondorcet->getChecksum())
		{
			$this->saveVotesList();
			R::store($this->_bean);
		}
	}

	protected function register (Condorcet\Condorcet $vote, $title)
	{
		$true = true ;

		$this->_bean = R::dispense( 'condorcet' );

		$this->_bean->title = htmlspecialchars($title);
		$this->_bean->read_code = bin2hex(openssl_random_pseudo_bytes(4, $true));
		$this->_bean->admin_code = bin2hex(openssl_random_pseudo_bytes(4, $true));

		$this->_bean->condorcet_object = serialize($vote);
		$this->_objectCondorcet = $vote ;
		$this->_bean->condorcet_version = $this->_objectCondorcet->getObjectVersion();

		$this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
		$this->_originalChecksum = $this->_bean->vote_checksum ;

		$this->_bean->candidates = serialize($this->_objectCondorcet->getCandidatesList());
		$this->saveVotesList();

		R::store($this->_bean) ;
	}

	protected function load ($read_code)
	{
		$this->_bean = R::findOne( 'condorcet', ' read_code = ? ', [ $read_code ]);

		if (is_null($this->_bean))
			{ throw new Exception ('Impossible de charger le vote'); }
		else
		{
			$this->_objectCondorcet = unserialize($this->_bean->condorcet_object) ;
			$this->_originalChecksum = $this->_objectCondorcet->getChecksum() ;
		}
	}

	protected function saveVotesList ()
	{
		$this->_bean->votes_list = serialize($this->_objectCondorcet->getVotesList());
	}
}