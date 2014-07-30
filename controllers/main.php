<?php

abstract class Controller
{
	public static $_ajax = false ;

		///////

	// Construction du head

	private static $_head_JS ;
	private static $_head_CSS ;
	private static $_head_Canonical ;

	protected static function AddJS ($url, $priority = 0)
	{
		if (!is_array(Controller::$_head_JS))
			{ Controller::$_head_JS = array(); }

		for ($i = $priority * 100 ; isset(Controller::$_head_JS[$i]) ; $i++ ) {}
		Controller::$_head_JS[$i] = $url ;
	}

	protected static function AddCSS ($url, $priority = 0)
	{
		if (!is_array(Controller::$_head_CSS))
			{ Controller::$_head_CSS = array(); }

		for ($i = $priority * 100 ; isset(Controller::$_head_CSS[$i]) ; $i++ ) {}
		Controller::$_head_CSS[$i] = $url ;
	}

	protected static function AddCanonical ($url)
	{
		self::$_head_Canonical = $url ;
	}

	protected static function setHead ()
	{
		if (!is_array(Controller::$_head_JS))
			{ Controller::$_head_JS = array(); }
		if (!is_array(Controller::$_head_CSS))
			{ Controller::$_head_CSS = array(); }

		ksort(Controller::$_head_JS);
		ksort(Controller::$_head_CSS);


		foreach ( Controller::$_head_CSS as $url )
		{
			echo '<link href="'.$url.'" rel="stylesheet">
			' ;
		}

		echo '

		';


		foreach ( Controller::$_head_JS as $url )
		{
			echo '<script src="'.$url.'"></script>
			' ;
		}

		echo '

		';

		echo '<link rel="icon" type="image/png" href="'.BASE_URL.'images/favicon.png" />
		' ;

		if (!is_null(self::$_head_Canonical))
			{ echo '<link rel="canonical" href="'.self::$_head_Canonical.'">'; }
	}


		//////

	protected $_view = 'Home' ;
	public $_partial = false ;

	public function __construct ()
	{}

	protected function getTitle ()
	{
		return $this->contextTitle() ;

	}

		protected function contextTitle ()
		{
			return $this->_view ;
		}

	public function showPage ($follow = null, $position = 'after')
	{
		// On passe le partiel cas échant
		if (is_object($follow))
			{ $follow->_partial = true ; }

		// On veut une erreur
		if ($this->_view !== 'Error' && Events::getFatalErrors() !== null)
		{
			( new Error_Controller() )->showPage() ;

			return Events::getFatalErrors() ;
		}

		// Error - Header
		$error_code = Events::getErrorCode() ;
		if ($error_code !== null && !$this->_partial)
		{
			if ($error_code === 404)
				{ header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found"); }
			elseif ($error_code === 500)
				{ header($_SERVER['SERVER_PROTOCOL'] . " 500 Internal Server Error"); }
			elseif ($error_code === 502)
				{ header($_SERVER['SERVER_PROTOCOL'] . " 502 Bad Gateway"); }
		}

		// Un peu d'Ajax ?
		if (!self::$_ajax && !$this->_partial)
		{
			self::AddCSS(BASE_URL.'view/CSS/bootstrap.min.css');
			self::AddCSS(BASE_URL.'view/CSS/font-awesome.min.css', 1);
			self::AddCSS(BASE_URL.'view/CSS/style_custom_bootstrap.css', 2);
			self::AddCSS(BASE_URL.'view/CSS/style.css', 3);

			self::AddJS('//ajax.googleapis.com/ajax/libs/jquery/'.CONFIG_JQUERY.'/jquery.min.js');
			self::AddJS(BASE_URL.'view/JS/bootstrap.min.js', 1);
			self::AddJS(BASE_URL.'view/JS/self.js', 9);


			require_once 'view/Skeleton/head.php';
			require_once 'view/Skeleton/header.php';
		}

		// Route classique
		if (is_object($follow) && $position === 'before')
			{ $follow->showPage(); }

			// Message d'erreurs
			if (Events::isAnyEvent(0,0))
			{
				require 'view/Parts/message.php';
			}

			// Base
			require_once 'view'.DIRECTORY_SEPARATOR.$this->_view .'.php';

		if (is_object($follow) && $position === 'after')
			{ $follow->showPage(); }


		// Un peu d'Ajax ?
		if (!self::$_ajax || $this->_partial)
		{
			require_once 'view/Parts/newVote.php';
			require_once 'view/Skeleton/footer.php';
		}
	}
}

// Include Controllers
foreach (glob( __DIR__ . "/*_Controller.php" ) as $filename)
{
	require_once $filename ;
}