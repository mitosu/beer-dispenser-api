<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\User;

final class UserToken
{
    private $value;

    public function __construct()
    {
        $this->value = sha1(uniqid());
    }

    public function value(): string
    {
        return $this->value;
    }
}