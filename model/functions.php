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