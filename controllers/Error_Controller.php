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

	protected function getTitle ()
	{
		return Events::getFatalErrors()[0]->_name ;
	}

}