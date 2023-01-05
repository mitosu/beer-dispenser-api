<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\User;

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