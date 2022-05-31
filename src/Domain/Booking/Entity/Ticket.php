<?php

namespace App\Domain\Booking\Entity;

class Ticket
{
    private Client $client;
    private FilmSession $filmSession;
    private string $filmName;
    private string $clientName;
    private string $clientPhone;
    private string $dateFilmSession;
    private string $timeSessionStart;
    private string $timeSessionEnd;

    public function __construct(Client $client, FilmSession $filmSession)
    {
        $this->clientName = $client->getName();
        $this->clientPhone = $client->getPhone();
        $this->filmName = $filmSession->getFilmName();
        $this->dateFilmSession = $filmSession->getDateFilmSession();
        $this->timeSessionStart = $filmSession->getTimeSessionStart();
        $this->timeSessionEnd = $filmSession->getTimeSessionEnd();
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
            'Время начала сеанса' => $this->timeSessionStart,
            'Время окончания сеанса' => $this->timeSessionEnd,
        ];
    }
}
