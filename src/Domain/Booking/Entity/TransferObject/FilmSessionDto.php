<?php

namespace App\Domain\Booking\Entity\TransferObject;

class FilmSessionDto
{
    public string $filmName;
    public string $filmLength;
    public string $dateTimeStartFilmSession;
    public int $ticketsCount;
}
