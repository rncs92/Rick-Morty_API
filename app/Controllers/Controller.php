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
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $characters = $this->client->createCharacterCollection($page);

        return new TwigView('characters', [
            'characters' => $characters,
            'page' => $page,
            'next_page' => min($page + 1, 42),
            'previous_page' => max(1, $page - 1),
            'home' => 1,

        ]);
    }

    public function getEpisodes(): TwigView
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $episodes = $this->client->createEpisodesCollection($page);

        return new TwigView('episodes', [
            'episodes' => $episodes,
            'page' => $page,
            'next_page' => min($page + 1, 3),
            'previous_page' => max(1, $page - 1),
            'home' => 1,
        ]);
    }

    public function getLocations(): TwigView
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $locations = $this->client->createLocationCollection($page);

        return new TwigView('locations', [
            'locations' => $locations,
            'page' => $page,
            'next_page' => min($page + 1, 7),
            'previous_page' => max(1, $page - 1),
            'home' => 1,
        ]);
    }

    public function getEpisodeCharacters(): TwigView
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        $episodeCharacters = $this->client->episodeCharacters($id);

        return new TwigView('episodeCharacters', [
            'episodeCharacters' => $episodeCharacters,
            'home' => 1,
        ]);
    }
}