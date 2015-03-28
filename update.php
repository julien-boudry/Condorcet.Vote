<?php

$to_update = R::find( 'condorcet', " condorcet_version = '-0.9' " );

foreach ($to_update as $election)
{
	( new Condorcet_Vote ($election->read_code) );
}