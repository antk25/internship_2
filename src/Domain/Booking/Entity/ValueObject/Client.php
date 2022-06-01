<?php

namespace App\Domain\Booking\Entity\ValueObject;

class Client
{
    private string $name;
    private string $phone;

    /**
     * @throws \Exception
     */
    public function __construct(string $name, string $phone)
    {
        $this->name = self::validateName($name);
        $this->phone = self::assertThatPhoneIsValid($phone);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @throws \Exception
     */
    private static function validateName(string $name): string
    {
        if (!preg_match('/[A-zА-я-]{3,15}$/m', $name)) {
            throw new \Exception('Invalid name');
        }

        return $name;
    }

    /**
     * @throws \Exception
     */
    private static function assertThatPhoneIsValid(string $phone): string
    {
        if (!preg_match('/\+?[78][-(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/m', $phone)) {
            throw new \Exception('Invalid phone format');
        }

        return $phone;
    }
}
