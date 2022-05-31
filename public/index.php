<?php

use App\Domain\Booking\Entity\Client;
use App\Domain\Booking\Entity\Factory\CreateNewClientDtoFactory;
use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\TransferObject\FilmSessionDto;
use App\Domain\Booking\Entity\TransferObject\NewClientDto;
use App\Domain\Booking\Entity\ValueObject\ClientName;
use App\Domain\Booking\Entity\ValueObject\ClientPhone;
use App\Domain\Booking\Entity\ValueObject\DateFilmSession;
use App\Domain\Booking\Entity\ValueObject\TimeStartFilmSession;
use App\Domain\Booking\Service\FilmSessionService;
use App\Domain\Booking\Service\TicketService;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$user1 = [
    'name' => 'John',
    'phone' => '+79155683810',
];

$user2 = [
    'name' => 'Luke',
    'phone' => '89155583815',
];

$filmSession1 = [
    'film' => 'Venom',
    'filmLength' => 109,
    'date' => '22.05.2022',
    'time' => '20:15',
    'numberOfSeats' => 10,
];

$dtoClientFactory = new CreateNewClientDtoFactory();

$dtoUser1 = $dtoClientFactory->createFromArray($user1);

$dtoUser2 = $dtoClientFactory->createFromArray($user2);


$dtoFilmSession = new FilmSessionDto();

$dtoFilmSession1 = $dtoFilmSession::createFromArray($filmSession1);

$filmSessionService = new FilmSessionService();

try {
    $filmSession1 = $filmSessionService->createFilmSession($dtoFilmSession1);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}


$ticketService = new TicketService();

try {
    $ticketService->createTicket($filmSession1, $dtoUser1);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

try {
    $ticketService->createTicket($filmSession1, $dtoUser2);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

$tickets = $filmSession1->getAllBookedTickets();

print_r($tickets);
