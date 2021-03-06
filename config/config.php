<?php

use RedBeanPHP\R;

// PROD
if ($_SERVER['SERVER_NAME'] !== 'localhost')
{
	define('CONFIG_ENV', 'PROD');
	define('BASE_URL', 'https://www.condorcet.vote/');

	// Ligne non-versionnées : BDD
	require_once 'config/prod.php';

	// Analytics
	define('GOOGLE_ANALYTICS', "
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-53480205-1', 'auto');
ga('send', 'pageview');
</script>");



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
		Condorcet\Election::setMaxParseIteration(50000);
		Condorcet\Election::setMaxVoteNumber(100000);

	// JS
		const CONFIG_JQUERY = '3.3.1';
		const CONFIG_JQUERY_SHA_384 = 'sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT';


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
