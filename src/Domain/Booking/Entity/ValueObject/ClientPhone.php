<?php

namespace App\Domain\Booking\Entity\ValueObject;

class ClientPhone
{
    private string $phone;

    /**
     * @throws \Exception
     */
    public function __construct(string $phone)
    {
        $this->phone = $this->validatePhone($phone);
    }

    public function getValue(): string
    {
        return $this->phone;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @throws \Exception
     */
    private function validatePhone(mixed $phone): mixed
    {
        if (!preg_match('/\+?[78][-(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/m', $phone)) {
            throw new \Exception('Invalid phone format');
        }

        return $phone;
    }
}
