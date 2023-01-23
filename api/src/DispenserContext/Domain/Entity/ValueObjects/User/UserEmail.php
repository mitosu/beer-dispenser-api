<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\ValueObjects\User;

use InvalidArgumentException;

final class UserEmail
{
    private $value;

    public function __construct(string $email)
    {
        $this->validate($email);
        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function validate(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                'Invalid email is not allowed.'
            );
        }
    }
}