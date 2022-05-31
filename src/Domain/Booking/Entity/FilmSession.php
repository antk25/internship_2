<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketsCollection;
use App\Domain\Booking\Entity\ValueObject\DateFilmSession;
use App\Domain\Booking\Entity\ValueObject\TimeStartFilmSession;

class FilmSession extends Film
{
    private string $timeEndFilmSession;
    private TicketsCollection $ticketsCollection;
    private string $id;

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

        $this->timeEndFilmSession = $this->calcTimeEndFilmSession();
        $this->ticketsCollection = new TicketsCollection();
        $this->id = uniqid();
    }

    /**
     * @throws \Exception
     */
    public function bookTicket(Client $client): void
    {
        if ($this->checkTicketsAvail()) {
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
            'Дата' => $this->getDateFilmSession(),
            'Время начала сеанса' => $this->getTimeStartFilmSession(),
            'Время окончания сеанса' => $this->getTimeEndFilmSession(),
            'Кол-во свободных мест' => $this->ticketsCount,
        ];
    }

    public function getDateFilmSession(): DateFilmSession
    {
        return $this->dateFilmSession;
    }

    public function getTimeStartFilmSession(): TimeStartFilmSession
    {
        return $this->timeStartFilmSession;
    }

    public function getTimeEndFilmSession(): string
    {
        return $this->timeEndFilmSession;
    }

    private function checkTicketsAvail(): bool
    {
        return $this->ticketsCount <= 0;
    }

    /**
     * @throws \Exception
     */
    private function calcTimeEndFilmSession(): string
    {
        $startSessionTime = \DateTime::createFromFormat('H:i', $this->timeStartFilmSession);

        $endSessionTime = $startSessionTime->add(new \DateInterval('PT' . $this->getFilmLength() . 'M'));

        return $endSessionTime->format('H:i');
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
