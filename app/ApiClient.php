<?php declare(strict_types=1);

namespace RickMorty;
use GuzzleHttp\Client;
use RickMorty\Models\Character;
use RickMorty\Models\Episode;
use stdClass;

class ApiClient
{
    private Client $client;
    private const API_URL_CHARACTER = 'https://rickandmortyapi.com/api/character';
    private const API_URL_CHARACTER2 = 'https://rickandmortyapi.com/api/character?page=2';
    private const API_URL_EPISODES = 'https://rickandmortyapi.com/api/episode';
    //private string $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        //$this->apiKey = $_ENV['API_KEY'];
    }

    public function fetchCharacters(): array
    {
        $response = $this->client->request('GET', self::API_URL_CHARACTER);
        $data = json_decode($response->getBody()->getContents());
        return $data->results;
    }

      public function fetchCharacters2(): array
    {
        $response = $this->client->request('GET', self::API_URL_CHARACTER2);
        $data = json_decode($response->getBody()->getContents());
        return $data->results;
    }

    public function fetchEpisodesById(int $id): Episode
    {
        $response = $this->client->request('GET', self::API_URL_EPISODES . "/$id");
        $data = json_decode($response->getBody()->getContents());
        return $this->createEpisode($data);
    }

    public function createCharacterCollection(): array
    {
        $charactersData = $this->fetchCharacters();

        $charactersCollection = [];
        foreach($charactersData as $character) {
            $charactersCollection[] = $this->createCharacter($character);
        }
        return $charactersCollection;

    }
    public function createCharacterCollection2(): array
    {
        $charactersData = $this->fetchCharacters2();

        $charactersCollection = [];
        foreach($charactersData as $character) {
            $charactersCollection[] = $this->createCharacter($character);
        }
        return $charactersCollection;
    }

    private function createCharacter(stdClass $character): Character
    {
        return new Character(
            $character->name,
            $character->status,
            $character->species,
            $character->location->name,
            $character->episode[0],
            $character->image,
            $character->url
        );
    }

    private function createEpisode(stdClass $episode): Episode
    {
        return new Episode(
            $episode->id,
            $episode->name,
            $episode->air_date,
            $episode->characters,
            $episode->url
        );
    }
}