<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\Exception\User;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
class UserAlreadyCreatedException extends ConflictHttpException
{
    public static function  userAlreadyStored($email): self
    {
        throw new self(sprintf('The user with the email %s already exists', $email));
    }
}