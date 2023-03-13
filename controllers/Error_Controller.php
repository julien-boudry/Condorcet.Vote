<?php

declare(strict_types=1);


class Error_Controller extends Controller
{
    protected string $_view = 'Error';

    //////

    public function __construct()
    {
        parent::__construct();

        foreach (Events::getFatalErrors() as $e) {
            var_dump($e);
        }
    }
        //////

    protected function getTitle(): string
    {
        return (string) Events::getFatalErrors()[0]->_name;
    }
}
