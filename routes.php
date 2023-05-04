<?php

use RickMorty\Controllers\Controller;

return [
    ['GET', '/', [Controller::class, 'getCharacters']],
    ['GET', '/?page=2', [Controller::class, 'getCharacters2']]
];