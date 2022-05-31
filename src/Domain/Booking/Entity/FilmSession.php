<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketsCollection;
use App\Domain\Booking\Entity\ValueObject\DateFilmSession;
use App\Domain\Booking\Entity\ValueObject\TimeStartFilmSession;

class FilmSession extends Film
{
    private string $timeEndFilmSession;
    private TicketsCollection $ticketsCollection;

    /**
     * @throws \Exception
     */
    public function __construct(
        string $filmName,
        int $filmLength,
        private readonly DateFilmSession $dateFilmSession,
        private readonly TimeStartFilmSession $timeStartFilmSession,
        private int $ticketsCount,
    ) {
        parent::__construct($filmName, $filmLength);

        $this->timeEndFilmSession = $this->calcEndSessionTime();
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

    /**
     * @return array<Ticket>
     */
    public function getAllBookedTickets(): array
    {
        $bookedTickets = [];

        foreach ($this->ticketsCollection as $value) {
            $bookedTickets[] = $value->getTicketInfo();
        }

        return $bookedTickets;
    }

    /**
     * @return array<mixed>
     */
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
        return $this->dateFilmSession;
    }

    public function getTimeSessionStart(): TimeStartFilmSession
    {
        return $this->timeStartFilmSession;
    }

    public function getTimeSessionEnd(): string
    {
        return $this->timeEndFilmSession;
    }

    /**
     * @throws \Exception
     */
    private function calcEndSessionTime(): string
    {
        $startTime = \DateTime::createFromFormat('H:i', $this->timeStartFilmSession);

        $endSessionTime = $startTime->add(new \DateInterval('PT' . $this->getFilmLength() . 'M'));

        return $endSessionTime->format('H:i');
    }
}
