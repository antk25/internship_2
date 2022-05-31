<?php

namespace App\Domain\Booking\Entity\ValueObject;

class ClientName
{
    private string $name;

    /**
     * @throws \Exception
     */
    public function __construct(string $name)
    {
        $this->name = $this->validateName($name);
    }

    /**
     * @throws \Exception
     */
    private function validateName($name)
    {
        if (!preg_match('/[A-zА-я-]{3,15}$/m', $name)) {
            throw new \Exception('Invalid name');
        }
        return $name;
    }

    public function getValue(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

}
