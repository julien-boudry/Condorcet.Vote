<?php

class Vote_Controller extends Controller
{
	protected $_view = 'vote' ;

	protected $_Condorcet_Vote = false ;
	protected $_objectCondorcet ;

		//////


	public function __construct ($build = false)
	{
		parent::__construct();

		// Construction depuis Edit
		if (is_object($build))
		{
			$this->_Condorcet_Vote = $build ;
			$this->_objectCondorcet = $this->_Condorcet_Vote->_objectCondorcet ;
		}
		// Construction depuis URL avec parametre(s) manquant(s)
		elseif (empty($_GET['vote']))
		{
			$this->_Condorcet_Vote = false;
		}
		// Tentative de construction depuis URL
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

	public function showPage ($follow = null, $position = 'after')
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