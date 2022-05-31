<?php

namespace App\Domain\Booking\Entity\ValueObject;

class TimeStartFilmSession
{
    private string $startTimeSession;

    /**
     * @throws \Exception
     */
    public function __construct(string $startTimeSession)
    {
        $this->startTimeSession = $this->setStartTime($startTimeSession);
    }

    public function getValue(): string
    {
        return $this->startTimeSession;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @throws \Exception
     */
    private function setStartTime(mixed $startTimeSession): string
    {
        $validateStartTime = \DateTime::createFromFormat('H:i', $startTimeSession);

        if ($validateStartTime === false) {
            throw new \Exception('Invalid date format');
        }

        return $validateStartTime->format('H:i');
    }
}
