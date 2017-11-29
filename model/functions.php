<?php

// SYSTEM

	set_error_handler(function($type, $msg, $file, $line, $context = array()) {

		if (CONFIG_ENV === 'DEV') {return FALSE ;}

		Events::add(new Error(500, null, $type.' - '.$msg, null, 2, 3) );

		( new Error_Controller() )->showPage();

		exit();
	});

// DIVERS

	function myPregMatch ($pattern, $subject)
	{
		return preg_match('/'.$pattern.'/', $subject);
	}

	function check_frontInput_method ()
	{
		if (!isset($_POST['methods']) || !is_array($_POST['methods']))
		{
			$post_methods = array();
		}
		else
		{
			$post_methods = $_POST['methods'];
		}

		$accept_methods = CONDORCET_METHOD;

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

	// Contenu des aides

	function setHelper ($type, $color = 'info')
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
				'All these methods meet the criteria of Condorcet. For more information on the different methods of calculation, look <a href="'.BASE_URL.'Condorcet_Methods" target="_blank">this page</a>.';
			break;

		case 'delete_infos':
			echo
				'Vote tags or numbers separated by semicolons. The operation will be performed before adding your new votes.';
			break;

		case 'personnal_vote':
			echo
				'The staff is used to allow voting once the voting for a person identified by name. The vote will then be provided specifically identifiable by a tag matching that name. <br>
				You must individually contact the url provided to the voter. ';
			break;

		case 'public_voting':
			echo 'If checked the vote will be disabled as well as the URL of public vote that personal URL.';
			break;

		case 'reset_url':
			echo 'Warning: Disable and re-enable the external voting also resets all URL. Public or personnal vote.';
			break;

			default:
				echo '????';
		}

		echo '</aside>';	
	}


	function setHtmlPairwise (array $pairwise)
	{ 
	?>
		<table class="table table-bordered text-center">
			<tr>
				<th class="text-center">#</th>
	<?php

				foreach ($pairwise as $candidate => $candidateValue)
				{
					echo '<th class="text-center"> x > ' . $candidate . '</th>' ;
				}
	?>
			</tr>
	<?php

			$i = 1 ;
			foreach ($pairwise as $candidate => $candidateValue)
			{
				echo '
				<tr class="pairwise-line">
					<th class="text-center">' . $candidate . ' > x</th>' ;

					$j = 1 ;
					foreach ($candidateValue['win'] as $adversaireName => $adversaireValue)
					{
						if ($i === $j)
						{
							echo '<td>-</td>';
							$j++;

						}
							if ($adversaireValue > $candidateValue['lose'][$adversaireName]) :
								$colorClass = 'success';
							elseif ($adversaireValue < $candidateValue['lose'][$adversaireName]):
								$colorClass = 'danger';
							else:
								$colorClass = 'info';
							endif;
							

							echo '<td class="' . $colorClass . '">' .
								$adversaireValue
							.'</td>' ;

						$j++;
					}
				echo ( (count($pairwise) === $i) ? '<td>-</td>' : '' ) ;
				echo '
				</tr>';

				$i++;
			}

	?>
		</table>
	<?php
	}