<?php

namespace App\Domain\Booking\Service;

use App\Domain\Booking\Entity\Client;
use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\NewClientDto;
use App\Domain\Booking\Entity\ValueObject\ClientName;
use App\Domain\Booking\Entity\ValueObject\ClientPhone;

class TicketService
{
    /**
     * @throws \Exception
     */
    public function createTicket(FilmSession $filmSession, NewClientDto $newClientDto): void
    {
        $client = new Client(new ClientName($newClientDto->name), new ClientPhone($newClientDto->phone));

        $filmSession->bookTicket($client);
    }
}
