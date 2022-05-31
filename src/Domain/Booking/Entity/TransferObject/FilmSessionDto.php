<?php

namespace App\Domain\Booking\Entity\TransferObject;

class FilmSessionDto
{
    public string $filmName;
    public string $filmLength;
    public string $dateFilmSession;
    public string $startTimeFilmSession;
    public int $ticketsCount;

    /** @var array<mixed> */
    public array $data;

    /**
     * @param array<mixed> $data
     *
     * @return static
     */
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
