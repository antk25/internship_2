<?php

namespace App\Domain\Booking\Service;

use App\Domain\Booking\Entity\Film;
use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\FilmSessionDto;
use App\Domain\Booking\Entity\ValueObject\DateTimeStartFilmSession;

class FilmSessionService
{
    private FilmSessionDto $filmSessionDto;

    /**
     * @throws \Exception
     */
    public function createFilmSession(FilmSessionDto $filmSessionDto): FilmSession
    {
        return new FilmSession(
            new Film($filmSessionDto->filmName, $filmSessionDto->filmLength),
            new DateTimeStartFilmSession($filmSessionDto->dateTimeStartFilmSession),
            $filmSessionDto->ticketsCount,
        );
    }
}
