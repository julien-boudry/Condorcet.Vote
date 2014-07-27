<?php

class Error_Controller extends Controller
{
	protected $_view = 'error' ;

		//////

	public function __construct ()
	{
		parent::__construct();
	}

	public function getErrorPage ()
	{
		require_once 'view/error.php';
	}

		//////

	public function getType ()
	{
		return parent::$_error_type ;
	}

	public function getDetails ()
	{
		return parent::$_error_details ;
	}
}