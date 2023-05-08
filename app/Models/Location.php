<?php

namespace RickMorty\Models;

class Location
{
    private int $id;
    private string $name;
    private string $dimension;
    private array $residents;
    private string $url;
    private string $type;

    public function __construct(int $id, string $name, string $type, string $dimension, array $residents, string $url)
        {
            $this->id = $id;
            $this->name = $name;
            $this->dimension = $dimension;
            $this->residents = $residents;
            $this->url = $url;
            $this->type = $type;
        }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDimension(): string
    {
        return $this->dimension;
    }

    public function getResidents(): array
    {
        return $this->residents;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
