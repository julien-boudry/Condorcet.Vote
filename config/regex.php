<?php

// Alphabet
define('REGEX_ALPHABET', 'a-zA-ZàáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ');

// Formats
define(
	'REGEX_ADD_NAME',
	'['.REGEX_ALPHABET.']+'
);

define(
	'REGEX_ADD_VOTE',
	'['.REGEX_ALPHABET.'0-9>= ]+'
);

define(
	'REGEX_ADMIN_DELETE_VOTE',
	'(['.REGEX_ALPHABET.'0-9 ]+;{1})*(['.REGEX_ALPHABET.'0-9 ]+)'
);

define(
	'REGEX_ADMIN_ADD_PERSONNAL_ID',
	'^['.REGEX_ALPHABET.'1-9]{1,'.NAME_MAX_LENGHT.'}$'
);

define(
	'REGEX_NEW_ADD_CANDIDATE',
	'(['.REGEX_ALPHABET.'0-9 ]+;{1}){1,}['.REGEX_ALPHABET.'0-9 ]+'
);

define(
	'REGEX_LINE_VOTE_FORMAT',
	'^(:?['.REGEX_ALPHABET.'0-9, ]+[|]{2} *)?(:?['.REGEX_ALPHABET.'0-9 ]+)(:?( *[>=]{1} *)(:?['.REGEX_ALPHABET.'0-9 ]+ *))*(:?[*] *[0-9]+ *)?$'
);