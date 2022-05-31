<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\ClientName;
use App\Domain\Booking\Entity\ValueObject\ClientPhone;

class Client
{
    /**
     * @throws \Exception
     */
    public function __construct(private readonly ClientName $name, private readonly ClientPhone $phone)
    {
    }

    public function getName(): ClientName
    {
        return $this->name;
    }

    public function getPhone(): ClientPhone
    {
        return $this->phone;
    }
}
