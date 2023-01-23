<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\ValueObjects\Dispenser;
use Negotiation\Exception\InvalidArgument;

class DispenserFlowVolume
{
    private $value;

    public function __construct(int $flowVolume)
    {
        $this->validate($flowVolume);
        $this->value = $flowVolume;
    }

    public function value(): int
    {
        return $this->value;
    }

    private function validate(int $value)
    {
        if ($value <= 0 || !is_int($value)) {
            throw new InvalidArgument(
                sprintf('Invalid value. The value must be greater than zero')
            );
        }
    }
}