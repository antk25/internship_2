<?php

namespace App\Domain\Booking\Entity;

class Film
{
    public function __construct(private readonly string $filmName, private readonly int $filmLength)
    {
    }

    public function getFilmName(): string
    {
        return $this->filmName;
    }

    public function getFilmLength(): int
    {
        return $this->filmLength;
    }
}
