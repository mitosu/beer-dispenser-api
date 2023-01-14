<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\Dispenser;

use InvalidArgumentException;

class DispenserAmount
{
    private $value;

    public function __construct(int $amount)
    {
        $this->validate($amount);
        $this->value = $amount;
    }

    public function value(): int
    {
        return $this->value;
    }

    private function validate(int $value)
    {
        if ($value <= 0 || !is_int($value)) {
            throw new InvalidArgumentException(
                sprintf('Invalid value. The value must be greater than zero')
            );
        }
    }

    public function decreaseAmountBy($anAmount)
    {
        return new self(
            $this->value() - $anAmount
        );
    }
}