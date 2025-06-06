<?php

declare(strict_types=1);

use CondorcetPHP\Condorcet\Throwable\ElectionObjectVersionMismatchException;
use RedBeanPHP\{OODBBean, R};
use CondorcetPHP\Condorcet\{Condorcet, Election, Vote};

class Condorcet_Vote
{
    public ?OODBBean $_bean;
    public Election $_objectCondorcet;
    protected bool $_isNew = false;
    protected bool $_checksum_change = false;
    protected bool $_forceUpdateCache = false;

    public function __construct(Election|string $vote, $title = null, $methods = null, $description = null)
    {
        if (\is_object($vote)) {
            $this->register($vote, $title, $methods, $description);
        } else {
            return $this->load($vote);
        }
    }

    public function __destruct()
    {
        if ($this->willUpdate()) {
            $this->_bean->last_update = R::isoDateTime();
            $this->_bean->count_update++;

            if ($this->_checksum_change) {
                $this->saveVotesList();
                $this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
                $this->writeVoteObject();
            }
        }

        if ($this->_forceUpdateCache) {
            $this->writeVoteObject();
        }

        // Enregistrement final conditionné à l'absence totale d'erreur
        if (!Events::isAnyError()) {
            R::store($this->_bean);
        }
    }

    public function willUpdate(): bool
    {
        $this->_checksum_change = ($this->_bean->vote_checksum !== $this->_objectCondorcet->getChecksum()) ? true : false;

        if (
            !$this->_isNew && (
                $this->_checksum_change
                ||
                $this->_bean->hasChanged('methods')
                ||
                $this->_bean->hasChanged('description')
            )
        ) {
            return true;
        } else {
            return false;
        }
    }

    protected function register(Election $vote, $title, $methods, $description = null): void
    {
        $this->_isNew = true;

        $this->_bean = R::dispense('condorcet');

        $this->_bean->title = $title;
        $this->_bean->description = (empty($description)) ? null : $description;

        $this->_bean->methods = json_encode([]);
        $this->update_methods($methods, false);

        $this->_bean->date = R::isoDateTime();
        $this->_bean->last_update = $this->_bean->date;
        $this->_bean->count_update = 0;

        $this->_bean->read_code = strtoupper(bin2hex(random_bytes(5)));
        $this->_bean->admin_code = strtoupper(bin2hex(random_bytes(5)));

        $this->setOpen(true);

        $this->_objectCondorcet = $vote;
        $this->_bean->condorcet_version = '-'.$this->_objectCondorcet->getObjectVersion(true);

        $this->_bean->candidates = json_encode($this->_objectCondorcet->getCandidatesListAsString());
        $this->saveVotesList();

        $this->prepareCondorcet();
        $this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
        $this->writeVoteObject();
    }

    protected function load(?string $read_code): void
    {
        $this->_bean = R::findOne('condorcet', ' read_code = ? ', [$read_code]);

        if ($this->_bean === null) {
            throw new Exception('Vote inexistant');
        } else {
            try {
                if ($this->_bean->condorcet_version !== '-'.Condorcet::getVersion(true)) {
                    throw new ElectionObjectVersionMismatchException;
                }


                $this->_objectCondorcet = $this->getVoteObject();
                $this->prepareCondorcet();
            } catch (ElectionObjectVersionMismatchException|NoCache) {
                // Update de l'objet & reconstruction
                $this->_objectCondorcet = new Election;

                // Reconstruction

                // Candidats
                $this->_objectCondorcet->addCandidatesFromJson($this->_bean->candidates);

                // Votes
                foreach (json_decode($this->_bean->votes_list, true) as $vote) {
                    $ranking = $vote['ranking'];
                    $tag = $vote['tag'];
                    $timestamp = $vote['timestamp'];

                    $this->_objectCondorcet->addVote(new Vote($ranking, $tag, $timestamp));
                }

                // Mise à jour
                $this->_bean->condorcet_version = '-'.$this->_objectCondorcet->getObjectVersion(true);
                $this->saveVotesList();
                $this->prepareCondorcet();
                $this->_bean->vote_checksum = $this->_objectCondorcet->getChecksum();
                $this->_forceUpdateCache = true;
            }
        }
    }

    protected function saveVotesList(): void
    {
        $voteList = $this->_objectCondorcet->getVotesList();

        foreach ($voteList as &$oneVote) {
            $NewoneVote = [];
            $NewoneVote['ranking'] = $oneVote->getSimpleRanking();
            $NewoneVote['tag'] = $oneVote->getTags();
            $NewoneVote['timestamp'] = $oneVote->getTimestamp();

            $oneVote = $NewoneVote;
        }

        $this->_bean->votes_list = json_encode($voteList);
    }

    public function update_methods($methods, $prepare = true): bool
    {
        // Check

        if (!\is_array($methods) || \count($methods) > \count(CONDORCET_METHOD)) {
            return false;
        }

        $auth_methods = CONDORCET_METHOD;
        foreach ($methods as &$oneMethod) {
            if ($oneMethod == 'Dodgson') {
                $oneMethod = 'Dodgson Quick';
            }

            if (!\in_array($oneMethod, $auth_methods, true)) {
                return false;
            }
        }

        $new_methods = json_encode($methods);

        if ($new_methods !== $this->_bean->methods) {
            $this->_bean->methods = $new_methods;

            if ($prepare) {
                $this->prepareCondorcet();
            }

            return true;
        }

        return false;
    }

    public function prepareCondorcet(): void
    {
        try {
            $this->_objectCondorcet->getWinner();
        } catch (CondorcetPHP\Condorcet\Throwable\CondorcetPublicApiException $e) {
        }


        foreach (json_decode($this->_bean->methods, true) as $method) {
            try {
                if ($method !== 'Dodgson') {
                    $this->_objectCondorcet->computeResult($method);
                }
            } catch (CondorcetPHP\Condorcet\Throwable\CandidatesMaxNumberReachedException $e) {
                // Events::add( new EventsError(server_code: 500, private_details: $e) );
            } catch (CondorcetPHP\Condorcet\Throwable\ResultRequestedWithoutVotesException $e) {
            }
        }
    }


    //////

    public function getTitle(): string
    {
        return htmlspecialchars($this->_bean->title ?? '');
    }

    public function getDescription(): string
    {
        return htmlspecialchars($this->_bean->description ?? '');
    }

    public function getDate(): string
    {
        return $this->_bean->date;
    }

    public function getUpdateDate(): string
    {
        return $this->_bean->last_update;
    }

    public function getCountUpdate(): int|string
    {
        return ($this->willUpdate()) ? $this->_bean->count_update + 1 : $this->_bean->count_update;
    }

    public function isOpen(): bool
    {
        return (bool) $this->_bean->open;
    }

    public function setOpen(bool $state): void
    {
        if ($state && !$this->_bean->open) {
            $this->set_new_hashCode();
            $this->_bean->open = true;
        }
    }

    public function getPublicURL(): string
    {
        return BASE_URL . 'Vote/' . $this->_bean->read_code . '/';
    }

    public function getAdminURL(): string
    {
        return BASE_URL . 'Vote/' . $this->_bean->read_code . '/Admin/' . $this->getAdminCode() . '/';
    }

    public function getAdminCode(): string
    {
        return $this->_bean->admin_code;
    }

    public function getHashCode(): string
    {
        return $this->_bean->hash_code;
    }

    public function getFreeVoteUrl(): string
    {
        return BASE_URL . 'Vote/' . $this->_bean->read_code . '/Public/' . $this->getFreeVoteCode() . '/';
    }

    public function getFreeVoteCode(): string
    {
        return strtoupper(substr(hash('sha224', $this->_bean->admin_code . $this->_bean->hash_code), 5, 8));
    }

    public function getPersonnalVoteBaseUrl(): string
    {
        return BASE_URL . 'Vote/' . $this->_bean->read_code . '/Personnal/';
    }

    public function getPersonnalVoteCode(string $name): string
    {
        return strtoupper(
            substr(
                hash(
                    'sha224',
                    $this->getAdminCode() .
                    $this->getHashCode() .
                    $name
                ),
                10,
                8
            )
        );
    }

    public function set_new_hashCode(): void
    {
        $this->_bean->hash_code = strtoupper(bin2hex(random_bytes(5)));
    }

    public function writeVoteObject(): void
    {
        file_put_contents($this->getSavedVoteObjectPath(), serialize($this->_objectCondorcet));
    }

    public function getVoteObject(): Election
    {
        $file_path = $this->getSavedVoteObjectPath();

        if (!file_exists($file_path)) {
            throw new NoCache;
        }

        return unserialize(file_get_contents($file_path));
    }

    public function getSavedVoteObjectPath(): string
    {
        return __DIR__.'/../cache/'.$this->_bean->read_code.'.election';
    }
}
