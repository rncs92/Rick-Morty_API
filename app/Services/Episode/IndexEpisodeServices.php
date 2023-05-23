<?php declare(strict_types=1);

namespace RickMorty\Services\Episode;

use RickMorty\ApiClient;
use RickMorty\Exceptions\PageNotFoundException;

class IndexEpisodeServices
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function handle(int $page): array
    {
        try {
            return $this->client->createEpisodesCollection($page);
        } catch (PageNotFoundException $exception) {
            return [];
        }
    }
}