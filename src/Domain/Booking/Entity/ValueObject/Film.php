<?php

namespace App\Domain\Booking\Entity\ValueObject;

class Film
{
    private mixed $filmLength;

    /**
     * @throws \Exception
     */
    public function __construct(private readonly string $filmName, int $filmLength)
    {
        $this->filmLength = self::filmLengthInDateInterval($filmLength);
    }

    public function getFilmName(): string
    {
        return $this->filmName;
    }

    public function getFilmLength(): \DateInterval
    {
        return $this->filmLength;
    }

    /**
     * @param mixed $filmLength
     *
     * @throws \Exception
     */
    private static function filmLengthInDateInterval(int $filmLength): \DateInterval
    {
        return new \DateInterval('PT' . $filmLength . 'M');
    }
}
