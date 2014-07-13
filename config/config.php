<?php

// PROD
if ($_SERVER['SERVER_NAME'] !== 'localhost')
{

}
// DEV
else
{
	R::setup('mysql:host=localhost;dbname=condorcet-vote','root','');
}

// All

	// Condorcet
		Condorcet\Condorcet::setMaxParseIteration(500);
		Condorcet\KemenyYoung::setMaxCandidates(4);

	// JS
		define('CONFIG_JQUERY', '2.1.1');