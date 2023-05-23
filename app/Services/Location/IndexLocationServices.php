<?php declare(strict_types=1);

namespace RickMorty\Services\Location;

use RickMorty\ApiClient;
use RickMorty\Exceptions\PageNotFoundException;

class IndexLocationServices
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function handle(int $page): array
    {
        try {
            return $this->client->createLocationCollection($page);
        } catch (PageNotFoundException $exception) {
            return [];
        }
    }
}