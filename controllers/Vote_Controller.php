<?php

class Vote_Controller extends Controller
{
	protected $_view = 'vote' ;

	protected $_Condorcet_Vote ;
	protected $_objectCondorcet ;

		//////


	public function __construct ()
	{
		parent::__construct();

		if (empty($_GET['vote']))
		{
			$this->_Condorcet_Vote = false;
		}
		else
		{
			try {
				$this->_Condorcet_Vote = new Condorcet_Vote ($_GET['vote']);
				$this->_objectCondorcet = $this->_Condorcet_Vote->_objectCondorcet ;
			} catch (Exception $e) {
				$this->_Condorcet_Vote = false ;				
			}
		}
	}

		//////

	public function showPage ()
	{
		if ($this->_Condorcet_Vote !== false)
		{
			parent::showPage();
		}
		else
		{
			$error = new Error_Controller(500);
			$error->showPage();
		}
	}

		//////

	

}