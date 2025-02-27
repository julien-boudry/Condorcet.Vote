<?php

declare(strict_types=1);

use CondorcetPHP\Condorcet\Utils\CondorcetUtil;

class Admin_Controller extends Controller
{
    protected string $_view = 'Admin';

    public const ERROR_URL = 'This vote or this admin code do not exist.';

    //////

    protected ?Condorcet_Vote $_Condorcet_Vote;


    public function __construct()
    {
        parent::__construct();

        // Edit Controller est appelé directement via URL (pas d'API)
        if (!isset($this->_Condorcet_Vote) && isset(Request::$get->vote, Request::$get->admin_code)) {
            try {
                $this->_Condorcet_Vote = new Condorcet_Vote(Request::$get->vote);
            } catch (Exception $e) {
                Events::add(new EventsError(server_code: 404, name: null, private_details: $e, public_details: self::ERROR_URL));

                $this->_Condorcet_Vote = null;

                return false;
            }

            // Controle de la validité du code
            if ($this->_Condorcet_Vote->_bean->admin_code !== Request::$get->admin_code) {
                Events::add(new EventsError(404, null, null, self::ERROR_URL));

                $this->_Condorcet_Vote = null;

                return false;
            }

            // Demande d'édition ?
            if (
                isset($_POST['is_edit'], $_POST['edit_description'], $_POST['delete_type'])


            ) {
                $this->update_vote();
            }
        }
    }


    protected function update_vote(): void
    {
        // Update (ou non) de la description (l'affichage de l'erreur est exclusivement géré en front)
        if (
            $_POST['edit_description'] !== $this->_Condorcet_Vote->_bean->description
            &&
            \strlen($_POST['edit_description']) <= CONFIG_DESCRIPTION_LENGHT
        ) {
            $this->_Condorcet_Vote->_bean->description = $_POST['edit_description'];
        }

        // Update (ou non) de la des methodes (l'affichage de l'erreur est exclusivement géré en front)
        $this->_Condorcet_Vote->update_methods(
            (empty($_POST['edit_methods'])) ? [] : $_POST['edit_methods']
        );

        // Open or close
        $this->_Condorcet_Vote->setOpen((isset($_POST['close'])) ? false : true);

        // Delete Votes
        if (!empty($_POST['delete_votes'])) {
            try {
                $delete_votes = $_POST['delete_votes'];

                if (CondorcetUtil::isValidJsonForCondorcet($delete_votes)) {
                    $delete_votes = CondorcetUtil::prepareJson($delete_votes);

                    if (!\is_array($delete_votes)) {
                        $delete_votes = [];
                    }
                } else {
                    $delete_votes = CondorcetUtil::prepareParse($delete_votes, false);
                }

                foreach ($delete_votes as &$value) {
                    if (is_numeric($value)) {
                        $value = \intval($value);
                    }
                }

                $delete_mode = ($_POST['delete_type'] === 'without') ? false : true;

                $counter_remove = \count($this->_Condorcet_Vote->_objectCondorcet->removeVotesByTags($delete_votes, $delete_mode));
                $this->_Condorcet_Vote->prepareCondorcet();

                Events::add(new Success($counter_remove . ' deleted votes'));
            } catch (Exception $e) {
            }
        }

        // Add votes
        if (!empty($_POST['add_votes'])) {
            try {
                if (CondorcetUtil::isValidJsonForCondorcet($_POST['add_votes'])) {
                    $counter = $this->_Condorcet_Vote->_objectCondorcet->jsonVotes($_POST['add_votes']);
                } else {
                    $counter = $this->_Condorcet_Vote->_objectCondorcet->parseVotes($_POST['add_votes']);
                }

                $this->_Condorcet_Vote->prepareCondorcet();

                Events::add(new Success($counter . ' recorded ' . (($counter > 1) ? 'votes' : 'vote')));
            } catch (CondorcetPHP\Condorcet\Throwable\CondorcetPublicApiException $e) {
                Events::add(new EventsError(502, null, $e, $e->getMessage(), 2, 0));
            }
        }
    }


    protected function getTitle(): string
    {
        return 'Admin Vote: ' . $this->_Condorcet_Vote->getTitle();
    }


    public function showPage(?Controller $follow = null, string $position = 'after'): void
    {
        if (isset($this->_Condorcet_Vote)) {
            parent::AddJS(BASE_URL.'view/JS/sha224.js', 3);
            parent::showPage(new Vote_Controller($this->_Condorcet_Vote));
        } else {
            parent::showPage();
        }
    }
}
