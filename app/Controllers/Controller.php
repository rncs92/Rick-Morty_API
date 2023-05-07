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
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $characters = $this->client->createCharacterCollection($page);

        return new TwigView('view', [
            'characters' => $characters,
            'page' => $page,
            'next_page' => $page +1,
            'previous_page' => max(1, $page - 1),
        ]);
    }
}