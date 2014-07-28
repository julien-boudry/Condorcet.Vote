<?php

class Error_Controller extends Controller
{
	protected $_view = 'Error' ;

		//////

	public function __construct ()
	{
		parent::__construct();
	}
		//////

	protected function contextTitle ()
	{
		return Events::getFatalErrors()[0]->_name ;
	}

}