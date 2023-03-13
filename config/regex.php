<?php
declare(strict_types=1);


// Alphabet
define('REGEX_ALPHABET', 'a-zA-ZàáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ');
define('REGEX_ALPHANUM', REGEX_ALPHABET.'0-9');

// Formats
define(
    'REGEX_TITLE',
    '^['.REGEX_ALPHABET.' ]{2,'.TITLE_MAX_LENGHT.'}$'
);

define(
    'REGEX_ADD_NAME',
    '^['.REGEX_ALPHABET.']{2,'.NAME_MAX_LENGHT.'}$'
);

define(
    'REGEX_ADD_VOTE',
    '^(:?['.REGEX_ALPHANUM.' ]+)(:?( *[>=]{1} *)(:?['.REGEX_ALPHANUM.' ]+ *))*?$'
);

define(
    'REGEX_ADMIN_DELETE_VOTE',
    '^(['.REGEX_ALPHANUM.' ]+;{1})*(['.REGEX_ALPHABET.'0-9 ]+)$'
);

define(
    'REGEX_ADMIN_ADD_PERSONNAL_ID',
    '^['.REGEX_ALPHANUM.']{1,'.NAME_MAX_LENGHT.'}$'
);

define(
    'REGEX_NEW_ADD_CANDIDATE',
    '^(['.REGEX_ALPHANUM.' ]+;{1}){1,}['.REGEX_ALPHANUM.' ]+$'
);

define(
    'REGEX_LINE_VOTE_FORMAT',
    '^(:?['.REGEX_ALPHANUM.', ]+[|]{2} *)?(:?['.REGEX_ALPHANUM.' ]+)(:?( *[>=]{1} *)(:?['.REGEX_ALPHANUM.' ]+ *))*(:?[*] *[0-9]+ *)?$'
);