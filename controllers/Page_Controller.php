<?php

class Page extends Controller
{}

// Include Controllers
foreach (glob( __DIR__ . "/Pages/*_Controller.php" ) as $filename)
{
	require_once $filename ;
}