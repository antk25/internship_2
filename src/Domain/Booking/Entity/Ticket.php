<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Client;
use App\Domain\Booking\Entity\FilmSession;
use JetBrains\PhpStorm\ArrayShape;

class Ticket
{
    private Client $client;
    private FilmSession $filmSession;
    private string $filmName;
    private string $clientName;
    private string $clientPhone;
    private string $dateSession;
    private string $startSession;
    private string $endSession;

    public function __construct(Client $client, FilmSession $filmSession)
    {
        $this->clientName = $client->getName();
        $this->clientPhone = $client->getPhone();
        $this->filmName = $filmSession->getFilmName();
        $this->dateSession = $filmSession->getDateSession();
        $this->startSession = $filmSession->getTimeSessionStart();
        $this->endSession = $filmSession->getTimeSessionEnd();
    }

    public function getTicketInfo(): array
    {
        return [
            'Имя' => $this->clientName,
            'Телефон' => $this->clientPhone,
            'Фильм' => $this->filmName,
            'Дата' => $this->dateSession,
            'Время начала сеанса' => $this->startSession,
            'Время окончания сеанса' => $this->endSession,
       ];
    }
}
