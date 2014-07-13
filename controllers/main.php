<?php

abstract class Controller
{
	public static $_ajax = false ;

		///////

	protected $_view = 'home' ;

	public function __construct ()
	{

	}

	protected function showError ()
	{
		require_once views/error.php ;
	}

	public function showPage ()
	{
		if (!self::$_ajax)
		{
			require_once 'view/head.php';
			require_once 'view/header.php';
		}

			require_once 'view'.DIRECTORY_SEPARATOR.$this->_view .'.php';

		if (!self::$_ajax)
		{
			require_once 'view/footer.php';
		}
	}
}

// Include Algorithms
foreach (glob( __DIR__ . "/*_Controller.php" ) as $filename)
{
	require_once $filename ;
}