<?php

use App\Domain\Booking\Entity\FilmSession;
use App\Domain\Booking\Entity\Client;
use App\Domain\Booking\Entity\TransferObject\FilmSessionDto;
use App\Domain\Booking\Entity\TransferObject\NewClientDto;
use App\Domain\Booking\Entity\ValueObject\DateSession;
use App\Domain\Booking\Entity\ValueObject\ClientPhone;
use App\Domain\Booking\Entity\ValueObject\ClientName;
use App\Domain\Booking\Entity\ValueObject\TimeSession;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$user1 = [
    'name' => 'John',
    'phone' => '+79155683810'
];

$user2 = [
    'name' => 'Luke',
    'phone' => '89155583815'
];

$filmSession1 = [
 'film' => 'Venom',
 'filmLength' => 109,
 'date' => '22.05.2022',
 'time' => '20:15',
 'numberOfSeats' => 10
];


$dto = new NewClientDto();
$dtoFilmSession = new FilmSessionDto();

$dtoFilmSession1 = $dtoFilmSession::createFromArray($filmSession1);

try {
        $filmSession1 = new FilmSession($dtoFilmSession1->filmName,
        $dtoFilmSession1->filmLength,
        new DateSession($dtoFilmSession1->dateFilmSession),
        new TimeSession($dtoFilmSession1->startTimeFilmSession),
        $dtoFilmSession1->ticketsCount);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

$dtoUser1 = $dto::createFromArray($user1);

$dtoUser2 = $dto::createFromArray($user2);

try {
    $client1 = new Client(new ClientName($dtoUser1->name), new ClientPhone($dtoUser1->phone));
    $client2 = new Client(new ClientName($dtoUser2->name), new ClientPhone($dtoUser2->phone));
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

try {
    $filmSession1->bookTicket($client1);
    $filmSession1->bookTicket($client2);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

$tickets = $filmSession1->getAllBookedTickets();
$aboutSession = $filmSession1->getInfoAboutFilmSession();

print_r($tickets);
