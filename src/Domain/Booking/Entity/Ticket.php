<?php

namespace App\Domain\Booking\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Ticket
{
    private UuidInterface $id;

    public function __construct(private readonly Client $client, private readonly FilmSession $filmSession)
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return array<mixed>
     */
    public function getTicketInfo(): array
    {
        return [
            'Имя' => $this->client->getName(),
            'Телефон' => $this->client->getPhone(),
            'Фильм' => $this->filmSession->getFilmNameCurrentFilmSession(),
            'Дата' => $this->filmSession->getDateFilmSession(),
            'Время начала сеанса' => $this->filmSession->getTimeStartFilmSession(),
            'Время окончания сеанса' => $this->filmSession->getTimeEndFilmSession(),
        ];
    }
}
