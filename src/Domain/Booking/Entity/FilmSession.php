<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketsCollection;
use App\Domain\Booking\Entity\ValueObject\DateFilmSession;
use App\Domain\Booking\Entity\ValueObject\TimeStartFilmSession;

class FilmSession extends Film
{
    private DateFilmSession $dateSession;
    private TimeStartFilmSession $timeSessionStart;
    private int $ticketsCount;
    private string $timeSessionEnd;
    private TicketsCollection $ticketsCollection;

    /**
     * @throws \Exception
     */
    public function __construct(
        string $filmName,
        int $filmLength,
        DateFilmSession $dateSession,
        TimeStartFilmSession $timeSessionStart,
        int $ticketsCount
    )
    {
        parent::__construct($filmName, $filmLength);
        $this->dateSession = $dateSession;
        $this->timeSessionStart = $timeSessionStart;
        $this->ticketsCount = $ticketsCount;
        $this->timeSessionEnd = $this->calcEndSessionTime();
        $this->ticketsCollection = new TicketsCollection();
    }

    /**
     * @throws \Exception
     */
    public function bookTicket(Client $client): void
    {
        if ($this->ticketsCount < 1) {
            throw new \Exception('No more tickets');
        }

        $this->ticketsCollection->addBookTicket($client, $this);

        $this->ticketsCount--;
    }

    public function getAllBookedTickets(): array
    {
        $bookedTickets = [];

        foreach ($this->ticketsCollection as $value) {
            $bookedTickets[] = $value->getTicketInfo();
        }

        return $bookedTickets;
    }

    public function getInfoAboutFilmSession(): array
    {
        return [
            'Фильм' => $this->getFilmName(),
            'Продолжительность' => $this->getFilmLength(),
            'Дата' => $this->getDateSession(),
            'Время начала сеанса' => $this->getTimeSessionStart(),
            'Время окончания сеанса' => $this->getTimeSessionEnd(),
            'Кол-во свободных мест' => $this->ticketsCount,
        ];
    }

    public function getDateSession(): DateFilmSession
    {
        return $this->dateSession;
    }

    public function getTimeSessionStart(): TimeStartFilmSession
    {
        return $this->timeSessionStart;
    }

    public function getTimeSessionEnd(): string
    {
        return $this->timeSessionEnd;
    }

    /**
     * @throws \Exception
     */
    private function calcEndSessionTime(): string
    {
        $startTime = \DateTime::createFromFormat('H:i', $this->timeSessionStart);

        $endSessionTime = $startTime->add(new \DateInterval('PT' . $this->getFilmLength() . 'M'));

        return $endSessionTime->format('H:i');
    }
}
