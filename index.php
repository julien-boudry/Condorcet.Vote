<?php
define('SCRIPT_START',microtime(true));


// Model
	require_once 'model/functions.php';
	require_once 'model/rb.php';
	require_once 'model/Condorcet/lib/Condorcet/Condorcet.php';
	require_once 'model/Condorcet_Vote.php';
	require_once 'model/Events.class.php';

// Config
	require_once 'config/config.php';
	require_once 'config/regex.php';

// Controller
	require_once 'controllers/main.php';

// Update Script
	 require_once 'update.php';

	if (isset($_GET['ajax']))
		{Controller::$_ajax = true;}


	if (!isset($_GET['route']))
	{
		$controller = new Home_Controller() ;
	}
	elseif (class_exists($_GET['route'].'_Controller'))
	{
		$controller_name = $_GET['route'].'_Controller' ;

		$controller = new $controller_name () ;
	}
	else
	{
		Events::add ( new Error(404, null, 'Route inexistante') );

		$controller = new Error_Controller() ;
	}

	$controller->showPage() ;


// Fin du script
unset($controller);

register_shutdown_function(function () {
	echo '<!-- Génération : '.number_format(microtime(true) - SCRIPT_START, 4).' seconde -->';
});