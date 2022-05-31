<?php

namespace App\Domain\Booking\Entity\Factory;

use App\Domain\Booking\Entity\TransferObject\NewClientDto;

class CreateNewClientDtoFactory
{
    /**
     * @param array<mixed> $data
     *
     */
    public function createFromArray(array $data): NewClientDto
    {
        $dto = new NewClientDto();

        $dto->name = $data['name'];
        $dto->phone = $data['phone'];

        return $dto;
    }
}
