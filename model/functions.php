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

// Contenu des aides

function setHelper($type, $color = 'info')
{
	echo '<aside class="bs-callout bs-callout-'.$color.'">';

	switch ($type) {
		case 'enter_candidates':
			echo
				'Each separated by a semicolon candidate. A candidate may take up to 30 alphanumeric characters but can not be a number. The front and rear spaces will be ignored.
				Of course, a minimum vote requires two candidates.';
			break;

		case 'enter_votes':
			echo
				"
				<h4>Syntax</h4>
Example with 4 candidates : A;B;C;D
<pre><code>tag1,tag2,tag3[...] || A>B=D>C # A comment at the end of the line prefixed by '#'. Never use ';' in comment!
Titan,CoteBoeuf || A>B=D>C # Tags at first, vote at second, separated by '||'
A>C>D>B # Line break to start a new vote. Tags are optionals. View above for vote syntax.
tag1,tag2,tag3 || A>B=D>C * 5 # This vote and his tag will be register 5 times
   tag1  ,  tag2, tag3     ||    A>B=D>C*2        # Working too.
C>D>B*8;A=D>B;Julien,Christelle||A>C>D>B*4;D=B=C>A # Alternatively, you can replace the line break by a semicolon.
B>C # Equivalent to B>C>A=D</code></pre>";
			break;

	case 'methods_infos':
		echo
			'All these methods meet the criteria of Condorcet. For more information on the different methods of calculation, look <a href="#" target="_blank">this page</a>.';
		break;

		default:
			echo '????';
	}

	echo '</aside>';	
}