<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\ClientName;
use App\Domain\Booking\Entity\ValueObject\ClientPhone;

class Client
{
    private string $id;
    private ClientName $name;
    private ClientPhone $phone;

    /**
     * @throws \Exception
     */
    public function __construct(ClientName $name, ClientPhone $phone)
    {
       $this->name = $name;
       $this->phone = $phone;
       $this->id = uniqid();
    }

    public function getName(): ClientName
    {
        return $this->name;
    }

    public function getPhone(): ClientPhone
    {
        return $this->phone;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
