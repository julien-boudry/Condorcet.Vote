<?php
declare(strict_types=1);


abstract class Controller
{
	public static $_ajax = false ;

		///////

	// Construction du head

	private static array $_head_JS = [] ;
	private static array $_head_CSS = [] ;
	private static string $_head_Canonical ;

	protected static function AddJS ($url, $priority = 0, $integrity = false, $crossorigin = false): void
	{
		if (!is_array(Controller::$_head_JS))
			{ Controller::$_head_JS = array(); }

		for ($i = $priority * 100 ; isset(Controller::$_head_JS[$i]) ; $i++ ) {}

		Controller::$_head_JS[$i] = ['url' => $url, 'integrity' => $integrity, 'crossorigin' => $crossorigin] ;
	}

	protected static function AddCSS ($url, $priority = 0, $integrity = false, $crossorigin = false): void
	{
		for ($i = $priority * 100 ; isset(Controller::$_head_CSS[$i]) ; $i++ ) {}
		Controller::$_head_CSS[$i] = ['url' => $url, 'integrity' => $integrity, 'crossorigin' => $crossorigin] ;
	}

	protected static function AddCanonical (string $url): void
	{
		self::$_head_Canonical = $url ;
	}

	protected static function setHead (): void
	{
		ksort(Controller::$_head_JS);
		ksort(Controller::$_head_CSS);

		foreach ( Controller::$_head_CSS as $input )
		{
			$sup ='';

			if ($input['integrity'] !== false) {
				$sup .= 'integrity="'.$input['integrity'].'" ';
			}

			if ($input['crossorigin'] !== false) {
				$sup .= 'crossorigin="'.$input['crossorigin'].'" ';
			}

			echo '<link href="'.$input['url'].'" rel="stylesheet" '.$sup.'>
			' ;
		}

		echo '

		';


		// Constance REGEX pour Javascript
		echo '<script>';
			foreach (get_defined_constants(true)['user'] as $constanteKey => $constanteValue)
			{
				if (substr($constanteKey, 0, 5) === 'REGEX')
				{
					echo $constanteKey . '="' . $constanteValue . '";
					' ;
				}
			}
		echo '</script>';

		foreach ( Controller::$_head_JS as $input )
		{
			$sup ='';

			if ($input['integrity'] !== false) {
				$sup .= 'integrity="'.$input['integrity'].'" ';
			}

			if ($input['crossorigin'] !== false) {
				$sup .= 'crossorigin="'.$input['crossorigin'].'" ';
			}

			echo '<script src="'.$input['url'].'" '.$sup.'></script>
			' ;
		}

		echo '

		';

		echo '<link rel="icon" type="image/png" href="'.BASE_URL.'view/IMG/favicon.png" />
		' ;

		if (isset(self::$_head_Canonical))
			{ echo '<link rel="canonical" href="'.self::$_head_Canonical.'" int>'; }
	}


		//////

	protected string $_view = 'Home' ;
	protected $_selfView = true ;
	public $_partial = false ;

	public function __construct ()
	{}

	protected function getTitle (): string
	{
		return SITE_HEAD_TITLE . ( (isset($this->_title)) ? $this->_title : $this->_view ) ;
	}


	public function showPage (?Controller $follow = null, string $position = 'after')
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
			http_response_code($error_code);
		}

		// Un peu d'Ajax ?
		if (!self::$_ajax && !$this->_partial)
		{
			self::AddCSS('https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',1,'sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu','anonymous');
			self::AddCSS(BASE_URL.'view/CSS/font-awesome.min.css', 2);
			self::AddCSS(BASE_URL.'view/CSS/style_custom_bootstrap.css', 3);
			self::AddCSS(BASE_URL.'view/CSS/style.css', 4);

			self::AddJS('https://code.jquery.com/jquery-'.CONFIG_JQUERY.'.min.js',1,CONFIG_JQUERY_HASH,'anonymous');
			self::AddJS('https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js', 2,'sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd','anonymous');
			self::AddJS(BASE_URL.'view/JS/php.js',3);
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
			if ($this->_selfView)
				{require_once 'view'.DIRECTORY_SEPARATOR.$this->_view .'.php';}

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