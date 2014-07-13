<?php

// Condorcet Class

// Model
require_once 'model/functions.php';
require_once 'model/rb.php';
require_once 'model/Condorcet/lib/Condorcet/Condorcet.php';

// Config
require_once 'config/config.php';
require_once 'config/schema.php';

// Controller
require_once 'view/head.php';
require_once 'view/header.php';

$config_routes = array(
	'home',
	'result',
	'edit'
);

if (!isset($_GET['route']))
{
	require_once 'controller'.DIRECTORY_SEPARATOR.'home_controller.php' ;
}
elseif (in_array($_GET['route'], $routes, true))
{
	require_once 'controller'.DIRECTORY_SEPARATOR.$_GET['route'].'_controler.php' ;
}
else
{
	require_once 'controller'.DIRECTORY_SEPARATOR.'error_controller.php' ;
}

require_once 'view/footer.php';