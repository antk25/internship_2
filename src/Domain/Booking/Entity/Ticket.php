<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\Client;
use Ramsey\Uuid\UuidInterface;

class Ticket
{
    public function __construct(private readonly UuidInterface $id, private readonly Client $client, private readonly FilmSession $filmSession)
    {
    }

    /**
     * @throws \Exception
     *
     * @return array<mixed>
     */
    public function getTicketInfo(): array
    {
        return [
            'Имя' => $this->client->getName(),
            'Телефон' => $this->client->getPhone(),
            'Фильм' => $this->filmSession->getFilmName(),
            'Дата и время начала сеанса' => $this->filmSession->getDateTimeStartFilmSession(),
            'Время окончания сеанса' => $this->filmSession->getTimeEndFilmSession(),
        ];
    }
}
