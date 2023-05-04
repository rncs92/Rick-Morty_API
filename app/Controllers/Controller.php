<?php declare(strict_types=1);

namespace RickMorty\Controllers;

use RickMorty\ApiClient;
use RickMorty\TwigView;

class Controller
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function getCharacters(): TwigView
    {
        $page = (int)$_GET['page'] ?? 1;

        $characters = $this->client->createCharacterCollection($page);

        return new TwigView('view', [
            'characters' => $characters,
        ]);
    }

    public function getCharacters2(): TwigView
    {
        $page = $_GET['page'];

        $characters = $this->client->createCharacterCollection($page);

        return new TwigView('view2', [
            'characters' => $characters,
        ]);
    }
}