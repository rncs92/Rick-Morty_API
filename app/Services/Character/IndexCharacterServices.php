<?php declare(strict_types=1);

namespace RickMorty\Services\Character;

use http\Client;
use RickMorty\ApiClient;
use RickMorty\Exceptions\PageNotFoundException;

class IndexCharacterServices
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function handle(int $page): array
    {
        try {
            return $this->client->createCharacterCollection($page);
        } catch (PageNotFoundException $exception) {
            return [];
        }
    }
}