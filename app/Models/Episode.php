<?php

namespace RickMorty\Models;

class Episode
{
    private int $id;
    private string $name;
    private string $aired;
    private array $characters;
    private string $url;
    private string $season;

    public function __construct(int $id, string $name, string $aired, string $season, array $characters, string $url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->aired = $aired;
        $this->characters = $characters;
        $this->url = $url;
        $this->season = $season;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAired(): string
    {
        return $this->aired;
    }

    public function getSeason(): string
    {
        return $this->season;
    }

    public function getCharacters(): array
    {
        return $this->characters;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}