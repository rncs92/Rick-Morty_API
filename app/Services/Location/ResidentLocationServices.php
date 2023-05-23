<?php declare(strict_types=1);

namespace RickMorty\Services\Location;

use RickMorty\ApiClient;
use RickMorty\Exceptions\CharacterNotFoundException;

class ResidentLocationServices
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function residents(int $id): array
    {
        try {
            return $this->client->locationResidents($id);
        } catch (CharacterNotFoundException $exception) {
            return [];
        }
    }
}