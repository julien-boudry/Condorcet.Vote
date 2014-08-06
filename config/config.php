<?php

// PROD
if ($_SERVER['SERVER_NAME'] !== 'localhost')
{
	define('CONFIG_ENV', 'PROD');
	define('BASE_URL', 'http://www.condorcet-vote.org/');

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

	// JS
		define('CONFIG_JQUERY', '2.1.1');


	// Methodes de Condorcet
		define('CONDORCET_METHOD', serialize(array(
			'Schulze (Winning variant, recommand by M.Schulze itself)' => 'Schulze',
			'Schulze (Margin variant)' => 'Schulze_Margin',
			'Kemeny-Young' =>  'KemenyYoung',
			'Ranked Pairs' =>  'RankedPairs',
			'Copeland' => 'Copeland',
			'Minimax (Winning variant)' =>  'Minimax_Winning',
			'Minimax (Margin variant)' =>  'Minimax_Margin',
			'Minimax (Opposition variant)' =>  'Minimax_Opposition'
		)));

	//INTERFACE
	define('CONFIG_DESCRIPTION_LENGHT', 1000);

	// Title
	define('SITE_HEAD_TITLE', 'Condorcet-Vote: Online Condorcet voting system | ');