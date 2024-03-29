<?php

declare(strict_types=1);

\define('SCRIPT_START', microtime(true));

// Config
require_once 'vendor/autoload.php';
require_once 'config/config.php';
require_once 'config/regex.php';

// Model
require_once 'model/functions.php';
require_once 'model/Condorcet_Vote.php';
require_once 'model/Events.class.php';
require_once 'model/NoCache.php';



// Controller
require_once 'controllers/main.php';

// Update Script
if (isset($_GET['update'])) {
    require_once 'update.php';
}

if (isset($_GET['ajax'])) {
    Controller::$_ajax = true;
}


if (!isset($_GET['route'])) {
    $controller = new Home_Controller;
} elseif (class_exists($_GET['route'].'_Controller')) {
    $controller_name = $_GET['route'].'_Controller';

    $controller = new $controller_name;
} elseif (strtolower($_GET['route']) === 'phpinfo') {
    phpinfo();
    exit();
} else {
    Events::add(new EventsError(404, null, 'Route inexistante'));

    $controller = new Error_Controller;
}

$controller->showPage();


// Fin du script
unset($controller);

register_shutdown_function(static function (): void {
    echo '<!-- Génération : '.number_format(microtime(true) - SCRIPT_START, 4).' seconde -->';
});
