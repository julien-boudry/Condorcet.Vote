<?php

declare(strict_types=1);

use CondorcetPHP\Condorcet\{Candidate, Vote};
use RedBeanPHP\R;

set_time_limit(600);

$manager = new CondorcetPHP\Condorcet\Timer\Manager;
$chrono = new CondorcetPHP\Condorcet\Timer\Chrono($manager);

unset($chrono);
$looking = $manager->getLastTimer();

$chrono = new CondorcetPHP\Condorcet\Timer\Chrono($manager);

// while (!empty($election = R::findOne('condorcet_archive',  " condorcet_version is null")))
// {
//     $election->condorcet_version = "-0.1";
//     $election->methods = json_encode(unserialize($election->methods));

//     R::store($election);
// }

// while (!empty($election = R::findOne('condorcet_archive',  " condorcet_version = '-0.1'")))
// {

//     $c = unserialize($election->candidates);

//     foreach ($c as &$e) {
//         if ($e instanceof Candidate) {
//             $e = $e->getName();
//         }
//     }

//     $election->candidates = json_encode($c);
//     $election->condorcet_version = "-0.2";

//     R::store($election);

//     gc_collect_cycles();
// }

// while (!empty($election = R::findOne('condorcet_archive',  " condorcet_version = '-0.2'")))
// {

//     $c = unserialize($election->votes_list);

//     foreach ($c as &$e) {
//         foreach ($e as $k => $r) {

//             if (is_int($k)) {
//                 $e['ranking'][$k] = $r;
//                 unset($e[$k]);
//             }
//         }
//     }

//     $election->votes_list = json_encode($c);
//     $election->condorcet_version = "-0.3";

//     R::store($election);

//     gc_collect_cycles();
// }

// exit();

while (!empty($election = R::findOne('condorcet', ' condorcet_version != -'.CondorcetPHP\Condorcet\Condorcet::getVersion(true)))) {
    ( new Condorcet_Vote($election->read_code) );
}

unset($chrono);
$updating = $manager->getLastTimer();

echo 'BBD : '.$looking.'<br>';
echo 'Condorcet : '.$updating.'<br>';

exit();
