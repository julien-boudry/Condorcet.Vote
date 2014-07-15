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

	function check_frontInput_method(array $post_methods)
	{
		$accept_methods = unserialize(CONDORCET_METHOD);

		foreach ($post_methods as $testMethod)
		{
			if (!in_array($testMethod, $accept_methods, true))
			{
				return false;
			}
		}

		return true ;
	}