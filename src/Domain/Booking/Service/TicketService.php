<?php

namespace App\Domain\Booking\Service;

use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\NewClientDto;
use App\Domain\Booking\Entity\ValueObject\Client;

class TicketService
{
    /**
     * @throws \Exception
     */
    public function createTicket(FilmSession $filmSession, NewClientDto $newClientDto): void
    {
        $client = new Client($newClientDto->name, $newClientDto->phone);

        $filmSession->bookTicket($client);
    }
}
