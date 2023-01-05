<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\User;

use InvalidArgumentException;

final class UserName
{
    private const MIN_LENGTH = 6;
    private $value;

    public function __construct(string $name)
    {
        $this->validate($name);
        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function validate(string $name)
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('Invalid name, is too short. Minimun length is %s', self::MIN_LENGTH)
            );
        }
    }
}