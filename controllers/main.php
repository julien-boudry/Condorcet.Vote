<?php

abstract class Controller
{
	public static $_ajax = false ;

	// Gestion des erreurs
	protected static $_error_type = false ;
	protected static $_error_details ;

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

	protected $_view = 'home' ;
	public $_partial = false ;

	public function __construct ()
	{}

	protected function getTitle ()
	{
		if (self::$_error_type !== false)
		{
			return 'Error ' . self::$_error_type ;
		}
		else
		{
			return $this->contextTitle() ;
		}
	}

		protected function contextTitle ()
		{
			return $this->_view ;
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
			self::AddCSS('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
			self::AddCSS('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', 1);
			self::AddCSS(BASE_URL.'view/style_custom_bootstrap.css', 2);
			self::AddCSS(BASE_URL.'view/style.css', 3);

			self::AddJS('//ajax.googleapis.com/ajax/libs/jquery/'.CONFIG_JQUERY.'/jquery.min.js');
			// self::AddJS('//ajax.googleapis.com/ajax/libs/jqueryui/'.CONFIG_JQUERY_UI.'/jquery-ui.min.js');
			self::AddJS('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', 1);
			self::AddJS(BASE_URL.'view/self.js', 9);


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