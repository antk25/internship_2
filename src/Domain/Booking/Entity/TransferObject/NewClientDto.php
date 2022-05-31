<?php

namespace App\Domain\Booking\Entity\TransferObject;

class NewClientDto
{
    public string $name;
    public string $phone;

    /** @var array<mixed> */
    public array $data;

    /**
     * @param array<mixed> $data
     *
     * @return static
     */
    public static function createFromArray(array $data): self
    {
        $dto = new self();

        $dto->name = $data['name'];
        $dto->phone = $data['phone'];

        return $dto;
    }
}
