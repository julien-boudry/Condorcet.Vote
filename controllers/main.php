<?php

abstract class Controller
{
	public static $_ajax = false ;

		///////

	protected $_view = 'home' ;
	public $_partial = false ;

	public function __construct ()
	{

	}

	protected function showError ()
	{
		require_once views/error.php ;
	}

	public function showPage ($follow = null, $position = 'after')
	{
		if (!self::$_ajax || $this->_partial)
		{
			require_once 'view/head.php';
			require_once 'view/header.php';
		}

			if (is_object($follow) && $position === 'before')
			{
				$follow->_partial = true ;
				$follor->showPage();
			}

			require_once 'view'.DIRECTORY_SEPARATOR.$this->_view .'.php';

			if (is_object($follow) && $position === 'after')
			{
				$follow->_partial = true ;
				$follow->showPage();
			}

		if (!self::$_ajax || $this->_partial)
		{
			require_once 'view/newVote.php';
			require_once 'view/footer.php';
		}
	}
}

// Include Algorithms
foreach (glob( __DIR__ . "/*_Controller.php" ) as $filename)
{
	require_once $filename ;
}