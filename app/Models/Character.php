<?php declare(strict_types=1);

namespace RickMorty\Models;

use RickMorty\ApiClient;

class Character
{
    private string $name;
    private string $status;
    private string $species;
    private string $location;
    private string $episode;
    private string $avatar;
    private string $url;

    public function __construct
    (
        string $name,
        string $status,
        string $species,
        string $location,
        string $episode,
        string $avatar,
        string $url
    )
    {
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->location = $location;
        $this->episode = $episode;
        $this->avatar = $avatar;
        $this->url = $url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getEpisode(): string
    {
        //return (int)preg_replace('/[^0-9]+/', '', $this->episode);
        return $this->episode;
    }
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

}