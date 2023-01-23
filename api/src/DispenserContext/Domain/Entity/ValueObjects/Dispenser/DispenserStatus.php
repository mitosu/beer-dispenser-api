<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\ValueObjects\Dispenser;

class DispenserStatus
{
    private bool $value;

    public function __construct(bool $status)
    {
        $this->value = $status;
    }

    public function value()
    {
        return $this->value;
    }
}