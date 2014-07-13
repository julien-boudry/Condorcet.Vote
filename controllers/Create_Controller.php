<?php

class Create_Controller extends Controller
{

		//////

	protected $_inputError = true ;

	public function __construct ($type = '500')
	{
		parent::__construct();
		
		if ($this->checkEmpty() && $this->registerCondorcet())
		{
			$this->_inputError = false ;
		}
	}

	public function checkEmpty ()
	{
		if	(
				!empty($_POST['candidates']) &&
				!empty($_POST['votes']) &&
				!empty($_POST['title']) && strlen($_POST['title']) < 80
			)
			{ return true ;	}
		else
			{ return false ; }
	}

	public function registerCondorcet ()
	{
		try
		{
			$new_vote = new Condorcet\Condorcet();

			$new_vote->parseCandidates($_POST['candidates']);

			$new_vote->parseVotes($_POST['votes']);
		}
		catch (Exception $e)
		{
			echo $e->getMessage() ;

			return false ;
		}

		$this->_new_vote = $new_vote ;

		return true ;
	}

		//////


	public function showPage ()
	{
		if ($this->_inputError)
		{
			$error = new Error_Controller(500);
			$error->showPage();
		}		
		else
		{
			var_dump($this->_new_vote->getWinner());
		}
	}

}