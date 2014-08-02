<?php

// PROD
if ($_SERVER['SERVER_NAME'] !== 'localhost')
{
	define('CONFIG_ENV', 'PROD');
	define('BASE_URL', 'http://localhost/PROJECTS/condorcet-vote/');

	R::setup('mysql:host=localhost;dbname=condorcet-vote','root','');

	// Analytics
	define('GOOGLE_ANALYTICS', '');
}
// DEV
else
{
	define('CONFIG_ENV', 'DEV');
	define('BASE_URL', 'http://localhost/PROJECTS/condorcet-vote/');

	R::setup('mysql:host=localhost;dbname=condorcet-vote','root','');

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
		Condorcet\Condorcet::setMaxParseIteration(50000);
		Condorcet\Condorcet::setMaxVoteNumber(100000);
		Condorcet\KemenyYoung::setMaxCandidates(5);

	// JS
		define('CONFIG_JQUERY', '2.1.1');


	// Methodes de Condorcet
		define('CONDORCET_METHOD', serialize(array(
			'Schulze (Winning variant, recommand by M.Schulze itself)' => 'Schulze',
			'Schulze (Margin variant)' => 'Schulze_Margin',
			'Kemeny-Young' =>  'KemenyYoung',
			'Copeland' => 'Copeland',
			'Minimax (Winning variant)' =>  'Minimax_Winning',
			'Minimax (Margin variant)' =>  'Minimax_Margin',
			'Minimax (Opposition variant)' =>  'Minimax_Opposition',
			'Ranked Pairs' =>  'RankedPairs'

		)));

	//INTERFACE
	define('CONFIG_DESCRIPTION_LENGHT', 1000);