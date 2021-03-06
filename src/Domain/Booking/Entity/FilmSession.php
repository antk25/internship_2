<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketsCollection;
use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\DateTimeStartFilmSession;
use App\Domain\Booking\Entity\ValueObject\Film;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class FilmSession
{
    private \DateTimeImmutable $timeEndFilmSession;
    private TicketsCollection $ticketsCollection;

    /**
     * @throws \Exception
     */
    public function __construct(
        private readonly UuidInterface $id,
        private readonly Film $film,
        private readonly DateTimeStartFilmSession $dateTimeStartFilmSession,
        private int $ticketsCount,
    ) {
        $this->timeEndFilmSession = $this->calcTimeEndFilmSession();
        $this->ticketsCollection = new TicketsCollection();
    }

    /**
     * @throws \Exception
     */
    public function bookTicket(Client $client): void
    {
        if ($this->checkTicketsAvail()) {
            throw new \Exception('No more tickets');
        }

        $ticketId = Uuid::uuid4();

        $ticket = new Ticket($ticketId, $client, $this);

        $this->ticketsCollection->addBookTicket($ticket);

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
     * @throws \Exception
     *
     * @return array<mixed>
     */
    public function getInfoAboutFilmSession(): array
    {
        return [
            'Фильм' => $this->film->getFilmName(),
            'Продолжительность' => $this->film->getFilmLength(),
            'Дата и время начала сеанса' => $this->getDateTimeStartFilmSession(),
            'Время окончания сеанса' => $this->getTimeEndFilmSession(),
            'Кол-во свободных мест' => $this->ticketsCount,
        ];
    }

    public function getFilmName(): string
    {
        return $this->film->getFilmName();
    }

    /**
     * @throws \Exception
     */
    public function getDateTimeStartFilmSession(): \DateTimeImmutable
    {
        return $this->dateTimeStartFilmSession->getValue();
    }

    public function getTimeEndFilmSession(): \DateTimeImmutable
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
    private function calcTimeEndFilmSession(): \DateTimeImmutable
    {
        $timeStart = $this->dateTimeStartFilmSession->getValue();

        return $timeStart->add($this->film->getFilmLength());
    }
}
