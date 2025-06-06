<?php

declare(strict_types=1);

use CondorcetPHP\Condorcet\Election;

class Vote_Controller extends Controller
{
    protected string $_view = 'Vote';

    protected ?Condorcet_Vote $_Condorcet_Vote;
    protected Election $_objectCondorcet;

    //////


    public function __construct(?Condorcet_Vote $build = null)
    {
        parent::__construct();

        // Construction depuis Edit
        if ($build !== null) {
            $this->_Condorcet_Vote = $build;
            $this->_objectCondorcet = $this->_Condorcet_Vote->_objectCondorcet;
        }
        // Construction depuis URL avec parametre(s) manquant(s)
        elseif (empty(Request::$get->vote)) {
            Events::add(new EventsError(404));
        }
        // Tentative de construction depuis URL
        else {
            try {
                $this->_Condorcet_Vote = new Condorcet_Vote(Request::$get->vote);
                $this->_objectCondorcet = $this->_Condorcet_Vote->_objectCondorcet;
            } catch (Exception $e) {
                Events::add(new EventsError(server_code: 404, private_details: $e));
                $this->_Condorcet_Vote = null;
            }
        }

        if (isset($this->_Condorcet_Vote)) {
            Controller::AddCanonical($this->_Condorcet_Vote->getPublicURL());
        }
    }


    protected function getTitle(): string
    {
        return 'Condorcet Vote: ' . $this->_Condorcet_Vote->getTitle();
    }
}
