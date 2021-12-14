<?php
declare(strict_types=1);


use RedBeanPHP\R;

// PROD
if ($_SERVER['SERVER_NAME'] !== 'localhost')
{
	define('CONFIG_ENV', 'PROD');
	define('BASE_URL', 'https://www.condorcet.vote/');

	// Ligne non-versionnées : BDD
	require_once 'config/prod.php';

	// Analytics
	define('GOOGLE_ANALYTICS', 	<<<EOD
									<!-- Global site tag (gtag.js) - Google Analytics -->
									<script async src="https://www.googletagmanager.com/gtag/js?id=UA-53480205-1"></script>
									<script>
									window.dataLayer = window.dataLayer || [];
									function gtag(){dataLayer.push(arguments);}
									gtag('js', new Date());

									gtag('config', 'UA-53480205-1');
									</script>
								EOD
	);



}
// DEV
else
{
	// DEBUG
	ini_set('xdebug.var_display_max_depth', -1);
	ini_set('xdebug.var_display_max_children', -1);
	ini_set('xdebug.var_display_max_data', -1);
	ini_set('display_errors', 1);
	error_reporting(E_ALL);



	define('CONFIG_ENV', 'DEV');
	define('BASE_URL', 'http://localhost/condorcet-vote/');

	R::setup('mysql:host=localhost;dbname=condorcet.vote','root','');

	// Gestionnaire d'exception
	set_exception_handler( function ($exception) {
		echo '<h1>Exception non-attrapée</h1>';
		var_dump($exception);}
	);

	// Analytics
	define('GOOGLE_ANALYTICS', '');
}

// All

	date_default_timezone_set('UTC');

	// Condorcet
		CondorcetPHP\Condorcet\Election::setMaxParseIteration(50000);
		CondorcetPHP\Condorcet\Election::setMaxVoteNumber(100000);

	// JS
		const CONFIG_JQUERY = '3.6.0';
		const CONFIG_JQUERY_SHA_384 = 'sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK';


	// Methodes de Condorcet
		const CONDORCET_METHOD = [
			'Schulze (Winning variant, recommended by M. Schulze himself)' => 'SchulzeWinning',
			'Schulze (Margin variant)' => 'SchulzeMargin',
			'Kemeny-Young' =>  'KemenyYoung',
			'Ranked Pairs Margin' =>  'RankedPairsMargin',
			'Ranked Pairs Winning' =>  'RankedPairsWinning',
			'Copeland' => 'Copeland',
			'Minimax (Winning variant)' =>  'MinimaxWinning',
			'Minimax (Margin variant)' =>  'MinimaxMargin',
			'Minimax (Opposition variant)' =>  'MinimaxOpposition',
			'Dodgson Quick' => 'DodgsonQuick',
			'Borda Count' => 'BordaCount',
			'Dowdall system' => 'DowdallSystem',
			'First-past-the-post' => 'FTPT',
			'Instant-Runoff - Alternative Vote' => 'InstantRunoff'
		];

	//INTERFACE
	const CONFIG_DESCRIPTION_LENGHT = 1000;
	const TITLE_MAX_LENGHT = 60;
	const NAME_MAX_LENGHT = 20;

	// Title
	const SITE_HEAD_TITLE = 'Condorcet.Vote: Online Condorcet voting system | ';
