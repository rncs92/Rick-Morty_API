<?php

use RickMorty\Controllers\Controller;

return [
    ['GET', '/', [Controller::class, 'getCharacters']],
];