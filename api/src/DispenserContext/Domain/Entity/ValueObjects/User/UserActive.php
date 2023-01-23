<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\ValueObjects\User;

final class UserActive
{
    private $value;
    public function __construct()
    {
        $this->value = false;
    }

    public function value(): bool
    {
        return $this->value;
    }
}