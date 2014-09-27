<?php

define(
	'REGEX_ADD_NAME',
	'[a-zA-ZàáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ]+'
);

define(
	'REGEX_ADD_VOTE',
	'[a-zA-Z0-9>=àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ ]+'
);


define(
	'REGEX_ADMIN_DELETE_VOTE',
	'([a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ ]+;{1})*([a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ ]+)'
);

define(
	'REGEX_ADMIN_ADD_PERSONNAL_ID',
	'[a-zA-Z1-9]+'
);


define(
	'REGEX_NEW_ADD_CANDIDATE',
	'([a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ ]+;{1}){1,}[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ ]+'
);