<?php declare(strict_types=1);

namespace RickMorty\Services\Episode;

use RickMorty\ApiClient;
use RickMorty\Exceptions\CharacterNotFoundException;

class CharactersEpisodeServices
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function characters(int $id): array
    {
        try {
            return $this->client->episodeCharacters($id);
        } catch (CharacterNotFoundException $exception) {
            return [];
        }
    }
}