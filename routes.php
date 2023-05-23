<?php declare(strict_types=1);

use RickMorty\Controllers\CharacterController;
use RickMorty\Controllers\EpisodeController;
use RickMorty\Controllers\LocationController;

return [
    ['GET', '/', [CharacterController::class, 'index']],
    ['GET', '/episodes', [EpisodeController::class, 'index']],
    ['GET', '/locations', [LocationController::class, 'index']],
    ['GET', '/episode-characters', [EpisodeController::class, 'characters']],
    ['GET', '/location-residents', [LocationController::class, 'residents']],
    ['GET', '/search', [CharacterController::class, 'search']],
];