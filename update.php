<?php
declare(strict_types=1);


use RedBeanPHP\R;

set_time_limit ( 600 );

$manager = new CondorcetPHP\Condorcet\Timer\Manager;
$chrono = new CondorcetPHP\Condorcet\Timer\Chrono ($manager);

# $to_update = R::find( 'condorcet', " condorcet_version != -".CondorcetPHP\Condorcet\Condorcet::getVersion('MAJOR') );

unset($chrono);
$looking = $manager->getLastTimer();

$chrono = new CondorcetPHP\Condorcet\Timer\Chrono ($manager);

while (!empty($election = R::findOne('condorcet',  " condorcet_version != -".CondorcetPHP\Condorcet\Condorcet::getVersion('MAJOR'))))
{
    ( new Condorcet_Vote ($election->read_code) );
}

unset($chrono);
$updating = $manager->getLastTimer();

echo 'BBD : '.$looking.'<br>';
echo 'Condorcet : '.$updating.'<br>';

exit();