<?php

namespace App\Domain\Booking\Entity\ValueObject;

class DateTimeStartFilmSession
{
    private string $dateTimeStartFilmSession;

    /**
     * @throws \Exception
     */
    public function __construct(string $dateTimeStart)
    {
        $this->dateTimeStartFilmSession = $dateTimeStart;
    }

    /**
     * @throws \Exception
     */
    public function getValue(): \DateTimeImmutable
    {
        return self::setStartDateTimeSession($this->dateTimeStartFilmSession);
    }

    /**
     * @throws \Exception
     */
    private static function setStartDateTimeSession(string $dateTimeStart): \DateTimeImmutable
    {
        $validateDate = \DateTimeImmutable::createFromFormat('d.m.Y H:i', $dateTimeStart);

        if ($validateDate === false) {
            throw new \Exception('Invalid date format');
        }

        return $validateDate;
    }
}
