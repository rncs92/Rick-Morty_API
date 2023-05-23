<?php declare(strict_types=1);

namespace RickMorty\Controllers;

use RickMorty\Services\Location\IndexLocationServices;
use RickMorty\Services\Location\ResidentLocationServices;
use RickMorty\TwigView;

class LocationController
{
    public function index(): TwigView
    {
        $services = new IndexLocationServices();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $locations = $services->handle($page);

        return new TwigView('locations', [
            'locations' => $locations,
            'page' => $page,
            'next_page' => min($page + 1, 7),
            'previous_page' => max(1, $page - 1),
            'home' => 1,
        ]);
    }

    public function residents(): TwigView
    {
        $services = new ResidentLocationServices();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        $residents = $services->residents($id);

        return new TwigView('locationResidents', [
            'locationResidents' => $residents,
            'home' => 1,
        ]);
    }
}