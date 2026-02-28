<?php
declare(strict_types=1);


// SYSTEM

set_error_handler(static function ($type, $msg, $file, $line, $context = []) {
    if (CONFIG_ENV === 'DEV') {
        return false;
    }

    if ($type & (\E_DEPRECATED | \E_USER_DEPRECATED)) {
        return false;
    }

    Events::add(new EventsError(500, null, $type.' - '.$msg.' - '.$file.' - '.$line, null, 2, 3));

    (new Error_Controller)->showPage();

    exit();
});

// DIVERS

function myPregMatch(string $pattern, string $subject): int|false
{
    return preg_match('/'.$pattern.'/', $subject);
}

function check_frontInput_method(): array|false
{
    if (!isset($_POST['methods']) || !\is_array($_POST['methods'])) {
        $post_methods = [];
    } else {
        $post_methods = $_POST['methods'];
    }

    $accept_methods = CONDORCET_METHOD;

    foreach ($post_methods as $testMethod) {
        if (!\in_array($testMethod, $accept_methods, true)) {
            return false;
        }
    }

    return $post_methods;
}

function showOneTagClass(string $tag): string
{
    if ($tag === 'Public-Vote') {
        return 'label-success';
    } elseif ($tag === 'Personnal-Vote') {
        return 'label-default';
    } else {
        return 'label-info';
    }
}

// Contenu des aides

function setHelper(string $type, string $color = 'info'): void
{
    echo '<aside class="bs-callout bs-callout-'.$color.'">';

    switch ($type) {
        case 'enter_candidates':
            echo 'Each candidate separated by a semicolon. A candidate name may be up to 30 alphanumeric characters but cannot be a number. Leading and trailing spaces will be ignored.
					Of course, a minimum vote requires two candidates.';
            break;

        case 'enter_votes':
            echo "
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
            echo 'All these methods meet the Condorcet criteria. For more information on the different calculation methods, see <a href="'.BASE_URL.'Condorcet_Methods" target="_blank">this page</a>.';
            break;

        case 'delete_infos':
            echo 'Vote tags or numbers separated by semicolons. The operation will be performed before adding your new votes.';
            break;

        case 'personnal_vote':
            echo 'This feature is used to allow a person identified by name to vote once. The vote will then be specifically identifiable by a tag matching that name. <br>
				You must individually share the provided URL with the voter. ';
            break;

        case 'public_voting':
            echo 'If checked, voting will be disabled, as well as both the public vote URL and the personal URLs.';
            break;

        case 'reset_url':
            echo 'Warning: Disabling and re-enabling external voting also resets all URLs, both public and personal.';
            break;

        default:
            echo '????';
    }

    echo '</aside>';
}


function setHtmlPairwise(array $pairwise): void
{
    ?>
		<table class="table table-bordered text-center">
			<tr>
				<th class="text-center">#</th>
	<?php

                foreach ($pairwise as $candidate => $candidateValue) {
                    echo '<th class="text-center"> x > ' . $candidate . '</th>';
                }
    ?>
			</tr>
	<?php

            $i = 1;
    foreach ($pairwise as $candidate => $candidateValue) {
        echo '
				<tr class="pairwise-line">
					<th class="text-center">' . $candidate . ' > x</th>';

        $j = 1;
        foreach ($candidateValue['win'] as $adversaireName => $adversaireValue) {
            if ($i === $j) {
                echo '<td>-</td>';
                $j++;
            }
            if ($adversaireValue > $candidateValue['lose'][$adversaireName]) {
                $colorClass = 'success';
            } elseif ($adversaireValue < $candidateValue['lose'][$adversaireName]) {
                $colorClass = 'danger';
            } else {
                $colorClass = 'info';
            }


            echo '<td class="' . $colorClass . '">' .
                $adversaireValue
            .'</td>';

            $j++;
        }
        echo (\count($pairwise) === $i) ? '<td>-</td>' : '';
        echo '
				</tr>';

        $i++;
    }

    ?>
		</table>
	<?php
}
