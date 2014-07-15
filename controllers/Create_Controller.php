<?php

class Create_Controller extends Controller
{

		//////

	protected $_inputError = true ;

	public function __construct ()
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
				!empty($_POST['title']) && strlen($_POST['title']) <= 80 &&
				isset($_POST['comment']) && strlen($_POST['comment']) <= 1000 &&
				!empty($_POST['methods']) && is_array($_POST['methods']) && check_frontInput_method($_POST['methods'])
			)
			{ return true ;	}
		else
			{ return false ; }
	}

	public function registerCondorcet ()
	{
		try
		{
			$new_condorcet = new Condorcet\Condorcet();

			if (Condorcet\Condorcet::isJson ($_POST['candidates']))
			{
				$new_condorcet->jsonCandidates($_POST['candidates']);
			}
			else
			{
				$new_condorcet->parseCandidates($_POST['candidates']);
			}

			if (Condorcet\Condorcet::isJson ($_POST['votes']))
			{
				$new_condorcet->jsonVotes($_POST['votes']);
			}
			else
			{
				$new_condorcet->parseVotes($_POST['votes']);
			}
		}
		catch (Exception $e)
		{
			echo $e->getMessage() ;

			return false ;
		}

		$this->_new_condorcet = new Condorcet_Vote($new_condorcet, $_POST['title'], $_POST['methods'], $_POST['comment']) ;

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
			$vote_admin_page = new Edit_Controller($this->_new_condorcet);
			$vote_admin_page->showPage();
		}
	}

}