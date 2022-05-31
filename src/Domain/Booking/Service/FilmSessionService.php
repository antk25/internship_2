<?php

namespace App\Domain\Booking\Service;

use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\FilmSessionDto;
use App\Domain\Booking\Entity\ValueObject\DateFilmSession;
use App\Domain\Booking\Entity\ValueObject\TimeStartFilmSession;

class FilmSessionService
{
    private FilmSessionDto $filmSessionDto;

    public function createFilmSession(FilmSessionDto $filmSessionDto): FilmSession
    {
        try {
            $filmSession = new FilmSession(
                $filmSessionDto->filmName,
                $filmSessionDto->filmLength,
                new DateFilmSession($filmSessionDto->dateFilmSession),
                new TimeStartFilmSession($filmSessionDto->startTimeFilmSession),
                $filmSessionDto->ticketsCount
            );
        } catch (\Exception $e) {
            echo $e->getMessage(), "\n";
        } finally {
            return $filmSession;
        }
    }
}
