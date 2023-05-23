<?php

namespace RickMorty\Services\Character;

use RickMorty\ApiClient;
use RickMorty\Exceptions\CharacterNotFoundException;

class SearchCharacterService
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function search(): array
    {
        try {
            return $this->client->searchCharacters();
        } catch (CharacterNotFoundException $exception) {
            return [];
        }
    }
}