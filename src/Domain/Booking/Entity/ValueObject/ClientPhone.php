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
        $this->phone = self::assertThatPhoneIsValid($phone);
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
    private static function assertThatPhoneIsValid(string $phone): string
    {
        if (!preg_match('/\+?[78][-(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/m', $phone)) {
            throw new \Exception('Invalid phone format');
        }

        return $phone;
    }
}
