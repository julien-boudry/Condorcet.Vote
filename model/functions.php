<?php

	function check_frontInput_method()
	{
		if (!isset($_POST['methods']) || !is_array($_POST['methods']))
		{
			$post_methods = array();
		}
		else
		{
			$post_methods = $_POST['methods'];
		}

		$accept_methods = unserialize(CONDORCET_METHOD);

		foreach ($post_methods as $testMethod)
		{
			if (!in_array($testMethod, $accept_methods, true))
			{
				return false;
			}
		}

		return $post_methods ;
	}

	function showOneTagClass ($tag)
	{
		if ($tag === 'Public-Vote')
		{
			return 'label-success' ;
		}
		elseif ($tag === 'Personnal-Vote')
		{
			return 'label-default' ;
		}
		else
		{
			return 'label-info' ;
		}
	}

set_error_handler(function($type, $msg, $file, $line, $context = array()) {

   if (CONFIG_ENV === 'DEV') {return FALSE ;}

    Events::add(new Error(500, null, $type.' - '.$msg, null, 2, 3) );

    ( new Error_Controller() )->showPage();

    exit();
});