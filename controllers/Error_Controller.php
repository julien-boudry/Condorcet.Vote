<?php
declare(strict_types=1);


class Error_Controller extends Controller
{
	protected $_view = 'Error' ;

		//////

	public function __construct ()
	{
		parent::__construct();

		foreach (Events::getFatalErrors() as $e) :
			var_dump($e);
		endforeach;
	}
		//////

	protected function getTitle (): string
	{
		return Events::getFatalErrors()[0]->_name ;
	}

}