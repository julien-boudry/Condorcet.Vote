<?php

// Model
	require_once 'model/functions.php';
	require_once 'model/rb.php';
	require_once 'model/Condorcet/lib/Condorcet/Condorcet.php';
	require_once 'model/Condorcet_Vote.php';

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
		$object_name = $_GET['route'].'_Controller' ;

		$controller = new $object_name () ;
	}
	else
	{
		$controller = new Error_Controller(404) ;
	}

	$controller->showPage() ;

