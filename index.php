<?php

// Model
	require_once 'model/functions.php';
	require_once 'model/rb.php';
	require_once 'model/Condorcet/lib/Condorcet/Condorcet.php';
	require_once 'model/Condorcet_Vote.php';
	require_once 'model/Events.class.php';

// Config
	require_once 'config/config.php';

// Controller
	require_once 'controllers/main.php';

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
		Events::add ( new Error('Index', 404, null, null) );

		$controller = new Error_Controller() ;
	}

	$controller->showPage() ;

