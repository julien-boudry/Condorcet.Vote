<?php

declare(strict_types=1);


class Add_Controller extends Controller
{
    protected string $_view = 'Add';

    //////

    protected ?Condorcet_Vote $_Condorcet_Vote;

    protected string $_mode;


    public function __construct()
    {
        parent::__construct();

        if (isset($_GET['vote'], $_GET['mode'])

        ) {
            try {
                $this->_Condorcet_Vote = new Condorcet_Vote($_GET['vote']);
            } catch (Exception $e) {
                Events::add(new EventsError(404));
                return false;
            }

            // Is Open ?
            if (!$this->_Condorcet_Vote->isOpen()) {
                Events::add(new EventsError(404, null, 'Le vote est fermé'));
                return false;
            }

            // Public Mode
            if (
                $_GET['mode'] === 'Public' &&
                isset($_GET['free_vote_code'])
            ) {
                $this->_mode = 'Public';

                if ($this->_Condorcet_Vote->getFreeVoteCode() !== $_GET['free_vote_code']) {
                    Events::add(new EventsError(404));
                    return false;
                }

                // Reception des votes
                if (
                    isset($_POST['add_vote_content'], $_POST['add_name'])

                ) {
                    // Check vote déjà existant
                    if (
                        !empty($_POST['add_name']) &&
                        !empty($this->_Condorcet_Vote->_objectCondorcet->getVotesList($_POST['add_name']))
                    ) {
                        Events::add(new EventsError(502, 'Double', null, 'You have already vote', 2, 0));
                        return false;
                    }

                    // Test d'enregistrement
                    $this->try_add_vote($_POST['add_name'], $_POST['add_vote_content']);
                }
            }
            // Personnal mode
            elseif (
                $_GET['mode'] === 'Personnal' &&
                isset($_GET['personnal_name']) && !empty($_GET['personnal_name']) &&
                isset($_GET['personnal_code'])
            ) {
                $this->_mode = 'Personnal';

                if ($this->_Condorcet_Vote->getPersonnalVoteCode($_GET['personnal_name']) !== $_GET['personnal_code']) {
                    Events::add(new EventsError(404, null, null, 'This vote or this code are false'));
                    $this->_Condorcet_Vote = null;
                    return false;
                }

                // Check vote déjà existant
                if (!empty($this->_Condorcet_Vote->_objectCondorcet->getVotesList($_GET['personnal_name']))) {
                    Events::add(new EventsError(502, 'Double', null, 'You have already vote', 2, 0));
                    return false;
                }

                // Reception des votes
                if (isset($_POST['add_vote_content'])) {
                    // Test d'enregistrement
                    $this->try_add_vote($_GET['personnal_name'], $_POST['add_vote_content']);
                }
            } else {
                $this->_Condorcet_Vote = null;
                return false;
            }
        }
    }

    protected function try_add_vote(string $name, string $vote): bool
    {
        if ($this->_mode === 'Public' && !empty($name) && !myPregMatch(REGEX_ADD_NAME, $name)) {
            Events::add(new EventsError(502, 'Add Register Vote Error', null, 'Incorrect Input', 2, 0));
            return false;
        }

        $tag = [
            ($this->_mode === 'Personnal') ? 'Personnal Vote' : 'Public Vote', $name,
        ];

        try {
            $this->_Condorcet_Vote->_objectCondorcet->addVote($vote, $tag);
            $this->_Condorcet_Vote->prepareCondorcet();

            Events::add(new Success('Your vote has been succefull register'));
        } catch (Exception $e) {
            Events::add(new EventsError(502, 'Add Register Vote Error', $e, $e->getMessage(), 2, 0));
            return false;
        }

        return true;
    }


    protected function getTitle(): string
    {
        return $this->_mode . ' Vote: ' . $this->_Condorcet_Vote->getTitle();
    }


    public function showPage(?Controller $follow = null, string $position = 'after'): void
    {
        if (isset($this->_Condorcet_Vote)) {
            if (Events::isAnysuccess()) {
                $this->_selfView = false;
            }

            parent::showPage(new Vote_Controller($this->_Condorcet_Vote));
        } else {
            Events::add(new EventsError(502));

            parent::showPage();
        }
    }
}
