<?php declare(strict_types=1);

namespace RickMorty;
use GuzzleHttp\Client;
use RickMorty\Model\Character;
use stdClass;

class ApiClient
{
    private Client $client;
    private const API_URL_CHARACTER = 'https://rickandmortyapi.com/api/character';
    //private string $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        //$this->apiKey = $_ENV['API_KEY'];
    }

    public function fetch()
    {
        $response = $this->client->request('GET', self::API_URL_CHARACTER);
        $data = json_decode($response->getBody()->getContents());
        return $data->results;
    }

    public function createCollection(): array
    {
        $charactersData = $this->fetch();
        $charactersCollection = [];
        foreach($charactersData as $characters) {
            $charactersCollection[] = $this->createCharacter($characters);
        }
        return $charactersCollection;
    }

    private function createCharacter(stdClass $char): Character
    {
        return new Character(
            $char->name,
            $char->status,
            $char->species,
            $char->location->name,
            $char->episode[0]
        );
    }
}