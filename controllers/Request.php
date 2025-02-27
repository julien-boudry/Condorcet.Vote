<?php
declare(strict_types=1);

class Request
{
    public static self $get;

    public static function init(): void
    {
        self::$get = new self();
    }

    public string $route = 'home'; // Valeur par défaut
    public ?string $vote = null;
    public ?string $admin_code = null;
    public ?string $mode = null;
    public ?string $free_vote_code = null;
    public ?string $personnal_name = null;
    public ?string $personnal_code = null;

    public function __construct()
    {
        $this->parseUri();
    }

    private function parseUri(): void
    {
        $uri = strtok($_SERVER["REQUEST_URI"], '?'); // Supprime les paramètres GET
        $segments = explode('/', trim($uri, '/'));

        // Vérifie et applique les règles
        if (count($segments) >= 2 && $segments[0] === 'Vote') {
            $this->vote = $segments[1];

            if (isset($segments[2])) {
                switch ($segments[2]) {
                    case 'Admin':
                        if (isset($segments[3])) {
                            $this->route = 'Admin';
                            $this->admin_code = $segments[3];
                        }
                        break;

                    case 'Public':
                        if (isset($segments[3])) {
                            $this->route = 'Add';
                            $this->mode = 'Public';
                            $this->free_vote_code = $segments[3];
                        }
                        break;

                    case 'Personnal':
                        if (isset($segments[3], $segments[4])) {
                            $this->route = 'Add';
                            $this->mode = 'Personnal';
                            $this->personnal_name = $segments[3];
                            $this->personnal_code = $segments[4];
                        }
                        break;

                    default:
                        $this->route = 'Vote';
                        break;
                }
            } else {
                $this->route = 'Vote';
            }
        } elseif (!empty($segments[0])) {
            $this->route = $segments[0];
        }
    }
}