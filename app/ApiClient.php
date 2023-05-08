<?php declare(strict_types=1);

namespace RickMorty;

use GuzzleHttp\Client;
use RickMorty\Models\Character;
use RickMorty\Models\Episode;
use RickMorty\Models\Location;
use stdClass;

class ApiClient
{
    private Client $client;
    private const API_URL_CHARACTER = 'https://rickandmortyapi.com/api/character';
    private const API_URL_EPISODES = 'https://rickandmortyapi.com/api/episode';
    private const API_URL_LOCATIONS = 'https://rickandmortyapi.com/api/location';

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

    public function fetchEpisodes($page = 1): array
    {
        if (!Cache::check('episodes_' . $page)) {
            $response = $this->client->request('GET', self::API_URL_EPISODES, [
                'query' => [
                    'page' => $page
                ]
            ]);
            $rawData = $response->getBody()->getContents();
            Cache::set('episodes_' . $page, $rawData);
        } else {
            $rawData = Cache::get('episodes_' . $page);
        }

        $data = json_decode($rawData);

        return $data->results;
    }

    public function fetchLocations($page = 1): array
    {
        if (!Cache::check('locations_' . $page)) {
            $response = $this->client->request('GET', self::API_URL_LOCATIONS, [
                'query' => [
                    'page' => $page
                ]
            ]);
            $rawData = $response->getBody()->getContents();
            Cache::set('locations_' . $page, $rawData);
        } else {
            $rawData = Cache::get('locations_' . $page);
        }

        $data = json_decode($rawData);

        return $data->results;
    }

    public function createEpisodesCollection(int $page): array
    {
        $episodesData = $this->fetchEpisodes($page);

        $episodesCollection = [];
        foreach ($episodesData as $episode) {
            $episodesCollection[] = $this->createEpisode($episode);
        }
        return $episodesCollection;
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

    public function createLocationCollection(int $page): array
    {
        $locationsData = $this->fetchLocations($page);

        $locationsCollection = [];
        foreach ($locationsData as $location) {
            $locationsCollection[] = $this->createLocation($location);
        }
        return $locationsCollection;

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
            $episode->episode,
            $episode->characters,
            $episode->url
        );
    }

    private function createLocation(stdClass $location): Location
    {
        return new Location(
            $location->id,
            $location->name,
            $location->type,
            $location->dimension,
            $location->residents,
            $location->url
        );
    }
}