<?php declare(strict_types=1);

namespace RickMorty\Controllers;

use RickMorty\Services\Character\IndexCharacterServices;
use RickMorty\Services\Character\SearchCharacterService;
use RickMorty\TwigView;

class CharacterController
{
    public function index(): TwigView
    {
        $service = new IndexCharacterServices();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $characters = $service->handle($page);

        return new TwigView('characters', [
            'characters' => $characters,
            'page' => $page,
            'next_page' => min($page + 1, 42),
            'previous_page' => max(1, $page - 1),
            'home' => 1,
        ]);
    }

    public function search(): TwigView
    {
        $service = new SearchCharacterService();
        $searchCollection = $service->search();

        return new TwigView('search', [
            'characters' => $searchCollection,
            'home' => 1,
        ]);
    }
}