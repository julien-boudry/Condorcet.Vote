<?php

class Create_Controller extends Admin_Controller
{
	protected $_inputError = true ;

	public function __construct ()
	{
		if ($this->checkEmpty() && $this->registerCondorcet())
		{
			$this->_inputError = false ;

			parent::__construct($this->_new_condorcet);
		}
		else
		{

		}


	}

	public function checkEmpty ()
	{
		$this->_accept_methods = check_frontInput_method();

		if	(
				!empty($_POST['candidates']) &&
				!empty($_POST['votes']) &&
				!empty($_POST['title']) && strlen($_POST['title']) <= 80 &&
				isset($_POST['description']) && strlen($_POST['description']) <= CONFIG_DESCRIPTION_LENGHT &&
				$this->_accept_methods !== false
			)
			{ return true ;	}
		else
			{
				$this->_inputError = 'Wrong input';
				return false ;
			}
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
			$this->_inputError = $e->getMessage() ;

			return false ;
		}

		$this->_new_condorcet = new Condorcet_Vote($new_condorcet, $_POST['title'], $this->_accept_methods, $_POST['description']) ;

		return true ;
	}

		//////


	public function showPage ($follow = null, $position = 'after')
	{
		if ($this->_inputError)
		{
			parent::$_error_type = 502 ;
			parent::$_error_details = 'Bad inputs' ;
		}

		parent::showPage() ;
	}

}