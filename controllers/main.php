<?php

abstract class Controller
{
	public static $_ajax = false ;

	// Gestion des erreurs
	protected static $_error_type = false ;
	protected static $_error_details ;

		///////

	protected $_view = 'home' ;
	public $_partial = false ;

	public function __construct ()
	{

	}

	public function showPage ($follow = null, $position = 'after')
	{
		// Error - Header
		if (self::$_error_type)
		{
			if (self::$_error_type === 404)
				{ header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found"); }
			elseif (self::$_error_type === 500)
				{ header($_SERVER['SERVER_PROTOCOL'] . " 500 Internal Server Error"); }
			elseif (self::$_error_type === 502)
				{ header($_SERVER['SERVER_PROTOCOL'] . " 502 Bad Gateway"); }
		}

		// Un peu d'Ajax ?
		if (!self::$_ajax || $this->_partial)
		{
			require_once 'view/head.php';
			require_once 'view/header.php';
		}

			// On veut une erreur
			if (self::$_error_type)
			{
				$error = new Error_Controller () ;
				$error->getErrorPage();
			}
			// Ou une page normale
			else
			{
				if (is_object($follow) && $position === 'before')
				{
					$follow->_partial = true ;
					$follow->showPage();
				}

				require_once 'view'.DIRECTORY_SEPARATOR.$this->_view .'.php';

				if (is_object($follow) && $position === 'after')
				{
					$follow->_partial = true ;
					$follow->showPage();
				}
			}

		// Un peu d'Ajax ?
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