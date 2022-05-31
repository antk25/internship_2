<?php

namespace App\Domain\Booking\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Ticket
{
    private UuidInterface $id;
    private Client $client;
    private FilmSession $filmSession;
    private string $filmName;
    private string $clientName;
    private string $clientPhone;
    private string $dateFilmSession;
    private string $timeStartFilmSession;
    private string $timeEndFilmSession;

    public function __construct(Client $client, FilmSession $filmSession)
    {
        $this->clientName = $client->getName();
        $this->clientPhone = $client->getPhone();
        $this->filmName = $filmSession->getFilmName();
        $this->dateFilmSession = $filmSession->getDateFilmSession();
        $this->timeStartFilmSession = $filmSession->getTimeStartFilmSession();
        $this->timeEndFilmSession = $filmSession->getTimeEndFilmSession();
        $this->id = Uuid::uuid4();
    }

    /**
     * @return array<mixed>
     */
    public function getTicketInfo(): array
    {
        return [
            'Имя' => $this->clientName,
            'Телефон' => $this->clientPhone,
            'Фильм' => $this->filmName,
            'Дата' => $this->dateFilmSession,
            'Время начала сеанса' => $this->timeStartFilmSession,
            'Время окончания сеанса' => $this->timeEndFilmSession,
        ];
    }
}
