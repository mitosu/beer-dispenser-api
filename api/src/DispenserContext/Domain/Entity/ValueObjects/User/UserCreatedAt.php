<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\ValueObjects\User;

use DateTime;

final class UserCreatedAt
{
    private $value;

    public function __construct()
    {
        $this->value = new DateTime();
    }

    public function value(): DateTime
    {
        return $this->value;
    }
}