<?php

namespace App\Domain\Booking\Entity\ValueObject;

class Client
{
    /**
     * @throws \Exception
     */
    public function __construct(private readonly string $name, private readonly string $phone)
    {
        self::assertThatNameIsValid($name);
        self::assertThatPhoneIsValid($phone);
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
    private static function assertThatNameIsValid(string $name): void
    {
        if (!preg_match('/[A-zА-я-]{3,15}$/m', $name)) {
            throw new \Exception('Invalid name');
        }
    }

    /**
     * @throws \Exception
     */
    private static function assertThatPhoneIsValid(string $phone): void
    {
        if (!preg_match('/\+?[78][-(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/m', $phone)) {
            throw new \Exception('Invalid phone format');
        }
    }
}
