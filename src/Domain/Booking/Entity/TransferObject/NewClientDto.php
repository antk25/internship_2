<?php

namespace App\Domain\Booking\Entity\TransferObject;

class NewClientDto
{
    public string $name;
    public string $phone;
    public array $data;

    public static function createFromArray(array $data): self
    {
        $dto = new self();

        $dto->name = $data['name'];
        $dto->phone = $data['phone'];

        return $dto;
    }
}
