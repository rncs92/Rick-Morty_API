<?php

use RickMorty\Controllers\Controller;

return [
    ['GET', '/', [Controller::class, 'getCharacters']],
    ['GET', '/episodes', [Controller::class, 'getEpisodes']],
    ['GET', '/locations', [Controller::class, 'getLocations']],
    ['GET', '/episode-characters', [Controller::class, 'getEpisodeCharacters']],
    ['GET', '/location-residents', [Controller::class, 'getLocationResidents']],
];