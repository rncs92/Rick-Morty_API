<?php declare(strict_types=1);

namespace RickMorty\Controllers;

use RickMorty\Services\Episode\CharactersEpisodeServices;
use RickMorty\Services\Episode\IndexEpisodeServices;
use RickMorty\TwigView;

class EpisodeController
{
    public function index(): TwigView
    {
        $service = new IndexEpisodeServices();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $episodes = $service->handle($page);

        return new TwigView('episodes', [
            'episodes' => $episodes,
            'page' => $page,
            'next_page' => min($page + 1, 3),
            'previous_page' => max(1, $page - 1),
            'home' => 1,
        ]);
    }

    public function characters(): TwigView
    {
        $services = new CharactersEpisodeServices();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        $characters = $services->characters($id);

        return new TwigView('episodeCharacters', [
            'episodeCharacters' => $characters,
            'home' => 1,
        ]);
    }
}