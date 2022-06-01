<?php

use App\Domain\Booking\Entity\Factory\CreateFilmSessionDtoFactory;
use App\Domain\Booking\Entity\Factory\CreateNewClientDtoFactory;
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
    'dateTimeStart' => '22.05.2022 20:15',
    'numberOfSeats' => 10,
];

$dtoFilmSessionFactory = new CreateFilmSessionDtoFactory();
$dtoClientFactory = new CreateNewClientDtoFactory();

$dtoUser1 = $dtoClientFactory->createFromArray($user1);
$dtoUser2 = $dtoClientFactory->createFromArray($user2);

$dtoFilmSession1 = $dtoFilmSessionFactory->createFromArray($filmSession1);

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

$aboutCurrentFilmSession = $filmSession1->getInfoAboutFilmSession();

print_r($tickets);
