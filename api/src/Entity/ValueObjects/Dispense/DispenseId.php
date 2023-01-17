<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\Dispense;

use Symfony\Component\Uid\Uuid;

final class DispenseId
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