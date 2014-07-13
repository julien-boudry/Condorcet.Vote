<?php

// PROD
if ($_SERVER['SERVER_NAME'] !== 'localhost')
{
	define('CONFIG_ENV', 'PROD');

	R::setup('mysql:host=localhost;dbname=condorcet-vote','root','');
}
// DEV
else
{
	define('CONFIG_ENV', 'DEV');

	R::setup('mysql:host=localhost;dbname=condorcet-vote','root','');
}

// All

	// Condorcet
		Condorcet\Condorcet::setMaxParseIteration(500);
		Condorcet\KemenyYoung::setMaxCandidates(4);

	// JS
		define('CONFIG_JQUERY', '2.1.1');