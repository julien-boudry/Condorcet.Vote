<?php

declare(strict_types=1);


class Page extends Controller
{
    protected string $_title = '';
}

// Include Controllers
foreach (glob(__DIR__ . '/Pages/*_Controller.php') as $filename) {
    require_once $filename;
}
