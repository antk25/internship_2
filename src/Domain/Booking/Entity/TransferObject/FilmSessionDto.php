<?php

namespace App\Domain\Booking\Entity\TransferObject;

class FilmSessionDto
{
    public string $filmName;
    public string $filmLength;
    public string $dateFilmSession;
    public string $startTimeFilmSession;
    public int $ticketsCount;
}
