<?php

	function jsLibrairies ($nom_librairie)
	{	
		if ($nom_librairie == 'jquery')
		{
			echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/'.CONFIG_JQUERY.'/jquery.min.js"></script>' ;
		}
		
		if ($nom_librairie == 'jquery-ui')
		{
			echo '<script src="//ajax.googleapis.com/ajax/libs/jqueryui/'.CONFIG_JQUERY_UI.'/jquery-ui.min.js"></script>' ;
		}				
	}

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