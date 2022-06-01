<?php

namespace App\Domain\Booking\Entity\ValueObject;

class DateFilmSession
{
    private string $date;

    /**
     * @throws \Exception
     */
    public function __construct(string $date)
    {
        $this->date = $this->setDate($date);
    }

    public function getValue(): string
    {
        return $this->date;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @throws \Exception
     */
    private function setDate(mixed $date): string
    {
        $validateDate = \DateTime::createFromFormat('d.m.Y', $date);

        if ($validateDate === false) {
            throw new \Exception('Invalid date format');
        }

        return $validateDate->format('d.m.Y');
    }
}
