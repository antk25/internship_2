<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketsCollection;
use App\Domain\Booking\Entity\ValueObject\DateFilmSession;
use App\Domain\Booking\Entity\ValueObject\TimeStartFilmSession;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class FilmSession
{
    private string $timeEndFilmSession;
    private TicketsCollection $ticketsCollection;
    private UuidInterface $id;

    /**
     * @throws \Exception
     */
    public function __construct(
        private readonly Film $film,
        private readonly DateFilmSession $dateFilmSession,
        private readonly TimeStartFilmSession $timeStartFilmSession,
        private int $ticketsCount,
    ) {
        $this->timeEndFilmSession = $this->calcTimeEndFilmSession();
        $this->ticketsCollection = new TicketsCollection();
        $this->id = Uuid::uuid4();
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
            'Фильм' => $this->film->getFilmName(),
            'Продолжительность' => $this->getFilmNameCurrentFilmSession(),
            'Дата' => $this->getDateFilmSession(),
            'Время начала сеанса' => $this->getTimeStartFilmSession(),
            'Время окончания сеанса' => $this->getTimeEndFilmSession(),
            'Кол-во свободных мест' => $this->ticketsCount,
        ];
    }

    public function getFilmNameCurrentFilmSession(): string
    {
        return $this->film->getFilmName();
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

        $endSessionTime = $startSessionTime->add(new \DateInterval('PT' . $this->film->getFilmLength() . 'M'));

        return $endSessionTime->format('H:i');
    }
}
