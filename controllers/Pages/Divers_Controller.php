<?php

declare(strict_types=1);


class Home_Controller extends Page
{
}

class About_Controller extends Page
{
    protected string $_view = 'About';
    protected string $_title = 'About Condorcet.Vote';
}

class Condorcet_Methods_Controller extends Page
{
    protected string $_view = 'Methods';
    protected string $_title = 'The Condorcet methods';
}

class Manual_Controller extends Page
{
    protected string $_view = 'Manual';
    protected string $_title = 'How to create an online Condorcet vote?';
}

class Donate_Controller extends Page
{
    protected string $_view = 'Donate';
    protected string $_title = 'Donate & Support Condorcet';
}
