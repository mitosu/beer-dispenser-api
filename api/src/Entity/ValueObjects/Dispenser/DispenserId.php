<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\Dispenser;

use Symfony\Component\Uid\Uuid;

final class DispenserId
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