<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\User;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

final class UserPassword
{
    private const MIN_LENGTH = 6;
    private $value;

    public function __construct(string $password)
    {
        $this->validate($password);
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function validate(string $password)
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw new BadRequestException(
                sprintf('Password is too short. Minimun length is %s', self::MIN_LENGTH)
            );
        }
    }
}