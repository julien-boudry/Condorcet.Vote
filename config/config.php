<?php
declare(strict_types=1);


use RedBeanPHP\R;

$port = !in_array($_SERVER['SERVER_PORT'], ['80', '443']) ? ':'.$_SERVER['SERVER_PORT'] : '';

// PROD
if ($_SERVER['SERVER_NAME'] !== 'localhost' || getenv('PRODUCTION') === 'true')
{
    define('CONFIG_ENV', 'PROD');

    define('BASE_URL', 'https://www.condorcet.vote'.$port.'/');

    if (file_exists($config_path = 'config/prod.php')) {
        require_once $config_path;
    } else {
        R::setup('mysql:host=mariadb;dbname=condorcet', 'condorcet_user', getenv('CONDORCETDB_USER_PASSWORD'));
    }
    // R::freeze( TRUE );

    // Analytics
    define('GOOGLE_ANALYTICS', 	<<<EOD
									<!-- Global site tag (gtag.js) - Google Analytics -->
									<script async src="https://www.googletagmanager.com/gtag/js?id=G-LNELZF59QE"></script>
									<script>
									window.dataLayer = window.dataLayer || [];
									function gtag(){dataLayer.push(arguments);}
									gtag('js', new Date());

									gtag('config', 'G-LNELZF59QE');
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
    define('BASE_URL', 'http://localhost'.$port.'/');

    R::setup('mysql:host=mariadb;dbname=condorcet', 'condorcet_user', getenv('CONDORCETDB_USER_PASSWORD'));

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
        const CONFIG_JQUERY = '3.6.4';
        const CONFIG_JQUERY_HASH = 'sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=';


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
