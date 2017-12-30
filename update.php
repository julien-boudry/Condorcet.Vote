<?php

use RedBeanPHP\R;

set_time_limit ( 600 );

$manager = new Condorcet\Timer\Manager;
$chrono = new Condorcet\Timer\Chrono ($manager);

$to_update = R::find( 'condorcet', " condorcet_version != -".Condorcet\Condorcet::getVersion('MAJOR') );

unset($chrono);
$looking = $manager->getLastTimer();

$chrono = new Condorcet\Timer\Chrono ($manager);

foreach ($to_update as $election)
{
    $nm = unserialize($election->methods);

    foreach ($nm as &$checkMethod) {
        $checkMethod = str_replace('_', '', $checkMethod);

        if ($checkMethod === 'Schulze') {
            $checkMethod = 'SchulzeWinning';
        }
        elseif ($checkMethod === 'RankedPairs') {
            $checkMethod = 'RankedPairsWinning';
        }
    }
    unset($checkMethod);

    $election->methods = serialize($nm);
}

foreach ($to_update as $election)
{
	( new Condorcet_Vote ($election->read_code) );
}

unset($chrono);
$updating = $manager->getLastTimer();

echo 'BBD : '.$looking.'<br>';
echo 'Condorcet : '.$updating.'<br>';

exit();