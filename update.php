<?php

$to_update = R::find( 'condorcet', " condorcet_version != -".Condorcet\Condorcet::getClassVersion() );

foreach ($to_update as $election)
{
	( new Condorcet_Vote ($election->read_code) );
}