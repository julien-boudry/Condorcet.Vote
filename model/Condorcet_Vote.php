<?php

class Condorcet_Vote
{
	protected $_bean ;
	public $_objectCondorcet ;

	public function __construct ($vote, $title = null, $comment = null)
	{		
		if (is_object($vote))
		{
			$this->register($vote, $title, $comment);
		}
		else
		{
			return $this->load($vote);
		}
	}

	public function __destruct ()
	{
		if	( $this->_bean->vote_checksum !== $this->_objectCondorcet->getChecksum() )
		{
			$this->saveVotesList();
			$this->_bean->condorcet_object = serialize($this->_objectCondorcet);
			$this->_bean->last_update = R::isoDateTime();
			$this->_bean->count_update++ ;

			R::store($this->_bean);
		}
	}

	protected function register (Condorcet\Condorcet $vote, $title, $comment)
	{
		$true = true ;

		$this->_bean = R::dispense( 'condorcet' );

		$this->_bean->title = $title;
		$this->_bean->comment = (empty($comment)) ? null : $comment;
		$this->_bean->date = R::isoDateTime();
		$this->_bean->last_update = $this->_bean->date;
		$this->_bean->count_update = 0;
		$this->_bean->read_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(4, $true)));
		$this->_bean->admin_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(4, $true)));

		$this->_objectCondorcet = $vote ;
		$this->_bean->condorcet_version = $this->_objectCondorcet->getObjectVersion();

		$this->_bean->candidates = serialize($this->_objectCondorcet->getCandidatesList());
		$this->saveVotesList();

		$this->prepareCondorcet();
		$this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
		$this->_bean->condorcet_object = serialize($this->_objectCondorcet);

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
			$this->prepareCondorcet();
		}
	}

	protected function saveVotesList ()
	{
		$this->_bean->votes_list = serialize($this->_objectCondorcet->getVotesList());
	}

	protected function prepareCondorcet ()
	{
		$this->_objectCondorcet->getWinner();

		foreach (unserialize(CONDORCET_METHOD) as $method)
		{
			$this->_objectCondorcet->getResult($method);
		}
	}


		//////

	public function getTitle ()
	{
		return htmlspecialchars($this->_bean->title) ;
	}

	public function getComment ()
	{
		return  htmlspecialchars($this->_bean->comment) ;
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
		return $this->_bean->count_update ;
	}

	public function format_VotesList ()
	{

	}
}