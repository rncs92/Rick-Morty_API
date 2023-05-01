<?php declare(strict_types=1);

namespace RickMorty\Model;

class Character
{
    private string $name;
    private string $status;
    private string $species;
    private string $location;
    private string $episode;

    public function __construct
    (
     string $name,
     string $status,
     string $species,
     string $location,
     string $episode
    )
    {
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->location = $location;
        $this->episode = $episode;
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
        return $this->episode;
    }
}