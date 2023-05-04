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
        $characters = $this->client->createCharacterCollection();

        return new TwigView('view', [
            'characters' => $characters,
        ]);
    }

    public function getCharacters2(): TwigView
    {
        $characters = $this->client->createCharacterCollection2();

        return new TwigView('view2', [
            'characters' => $characters,
        ]);
    }
}