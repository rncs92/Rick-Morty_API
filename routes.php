<?php

use RickMorty\Controllers\Controller;

return [
    ['GET', '/', [Controller::class, 'getCharacters']],
    ['GET', '/chars2', [Controller::class, 'getCharacters2']]
];