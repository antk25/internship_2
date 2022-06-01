<?php

namespace App\Domain\Booking\Service;

use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\FilmSessionDto;
use App\Domain\Booking\Entity\ValueObject\DateTimeStartFilmSession;
use App\Domain\Booking\Entity\ValueObject\Film;
use Ramsey\Uuid\Uuid;

class FilmSessionService
{
    private FilmSessionDto $filmSessionDto;

    /**
     * @throws \Exception
     */
    public function createFilmSession(FilmSessionDto $filmSessionDto): FilmSession
    {
        return new FilmSession(
            Uuid::uuid4(),
            new Film($filmSessionDto->filmName, $filmSessionDto->filmLength),
            new DateTimeStartFilmSession($filmSessionDto->dateTimeStartFilmSession),
            $filmSessionDto->ticketsCount,
        );
    }
}
