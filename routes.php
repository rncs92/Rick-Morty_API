<?php

use RickMorty\Controllers\Controller;

return [
    ['GET', '/', [Controller::class, 'getCharacters']],
    ['GET', '/episodes', [Controller::class, 'getEpisodes']],
    ['GET', '/locations', [Controller::class, 'getLocations']],
];