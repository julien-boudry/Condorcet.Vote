<?php

class Home_Controller extends Page
{}

class About_Controller extends Page
{ protected $_view = 'About' ; protected $_title = 'About Condorcet-Vote.org' ; }

class Condorcet_Methods_Controller extends Page
{ protected $_view = 'Methods' ; protected $_title = 'The Condorcet methods' ; }

class Manual_Controller extends Page
{ protected $_view = 'Manual' ; protected $_title = 'How to create an online Condorcet vote?' ; }