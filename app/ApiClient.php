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
    private const API_URL_EPISODES = 'https://rickandmortyapi.com/api/episode';

    //private string $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        //$this->apiKey = $_ENV['API_KEY'];
    }

    public function fetchCharacters(int $page = 1): array
    {
        if (!Cache::check('characters_' . $page)) {
            $response = $this->client->request('GET', self::API_URL_CHARACTER, [
                'query' => [
                    'page' => $page,
                ],
            ]);
            $rawData = $response->getBody()->getContents();
            Cache::set('characters_' . $page, $rawData);
        } else {
            $rawData = Cache::get('characters_' . $page);
        }

        $data = json_decode($rawData);

        return $data->results;
    }

    public function fetchEpisodesById(int $id): Episode
    {
        if (!Cache::check('episode_' . $id)) {
            $response = $this->client->request('GET', self::API_URL_EPISODES . "/$id");
            $rawData = $response->getBody()->getContents();
            Cache::set('episode_' . $id, $rawData);
        } else {
            $rawData = Cache::get('episode_' . $id);
        }

        $data = json_decode($rawData);

        return $this->createEpisode($data);
    }

    public function createCharacterCollection(int $page): array
    {
        $charactersData = $this->fetchCharacters($page);

        $charactersCollection = [];
        foreach ($charactersData as $character) {
            $charactersCollection[] = $this->createCharacter($character);
        }
        return $charactersCollection;

    }

    private function createCharacter(stdClass $character): Character
    {
        $id = (int)preg_replace('/[^0-9]+/', '', $character->episode[0]);
        return new Character(
            $character->name,
            $character->status,
            $character->species,
            $character->location->name,
            $character->episode[0],
            $character->image,
            $character->url,
            $this->fetchEpisodesById($id)
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