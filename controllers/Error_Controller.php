<?php

class Error_Controller extends Controller
{
	protected $_view = 'error' ;

		//////

	protected $_type = 500 ;

	public function __construct ($type = 500)
	{
		parent::__construct();

		$this->_type = $type ;
	}

	public function getType ()
	{
		return (is_int($this->_type)) ? $this->_type : '' ;
	}

	public function getDetails ()
	{
		return (is_string($this->_type)) ? $this->_type : '' ;
	}
}