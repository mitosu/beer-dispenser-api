<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\User;

use Symfony\Component\Uid\Uuid;

final class UserId
{
    private $value;

    public function __construct()
    {
        $this->value = Uuid::v4()->toRfc4122();
    }

    public function value(): string
    {
        return $this->value;
    }
}