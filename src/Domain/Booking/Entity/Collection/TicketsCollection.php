<?php

namespace App\Domain\Booking\Entity\Collection;

use App\Domain\Booking\Entity\Client;
use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\Ticket;

class TicketsCollection implements \Iterator
{
    private int $position;

    /** @var array<Ticket> */
    private array $tickets = [];

    public function __construct()
    {
        $this->position = 0;
    }

    public function addBookTicket(Client $client, FilmSession $filmSession): void
    {
        $this->tickets[] = new Ticket($client, $filmSession);
    }

    public function current(): Ticket
    {
        return $this->tickets[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->tickets[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
