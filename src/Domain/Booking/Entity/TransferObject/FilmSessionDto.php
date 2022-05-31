<?php

namespace App\Domain\Booking\Entity\TransferObject;

class FilmSessionDto
{
    public string $filmName;
    public string $filmLength;
    public string $dateFilmSession;
    public string $startTimeFilmSession;
    public int $ticketsCount;
    public array $data;

    public static function createFromArray(array $data): self
    {
        $dto = new self();

        $dto->filmName = $data['film'];
        $dto->filmLength = $data['filmLength'];
        $dto->dateFilmSession = $data['date'];
        $dto->startTimeFilmSession = $data['time'];
        $dto->ticketsCount = $data['numberOfSeats'];

        return $dto;
    }
}
