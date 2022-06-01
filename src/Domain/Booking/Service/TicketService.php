<?php

namespace App\Domain\Booking\Service;

use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\NewClientDto;
use App\Domain\Booking\Entity\ValueObject\Client;
use Ramsey\Uuid\Uuid;

class TicketService
{
    /**
     * @throws \Exception
     */
    public function createTicket(FilmSession $filmSession, NewClientDto $newClientDto): void
    {
        $client = new Client($newClientDto->name, $newClientDto->phone);

        $filmSession->bookTicket(Uuid::uuid4(), $client);
    }
}
