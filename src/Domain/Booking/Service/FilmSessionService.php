<?php

namespace App\Domain\Booking\Service;

use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\FilmSessionDto;
use App\Domain\Booking\Entity\ValueObject\DateFilmSession;
use App\Domain\Booking\Entity\ValueObject\TimeStartFilmSession;

class FilmSessionService
{
    private FilmSessionDto $filmSessionDto;

    /**
     * @throws \Exception
     */
    public function createFilmSession(FilmSessionDto $filmSessionDto): FilmSession
    {
        return new FilmSession(
            $filmSessionDto->filmName,
            $filmSessionDto->filmLength,
            new DateFilmSession($filmSessionDto->dateFilmSession),
            new TimeStartFilmSession($filmSessionDto->startTimeFilmSession),
            $filmSessionDto->ticketsCount,
        );
    }
}
