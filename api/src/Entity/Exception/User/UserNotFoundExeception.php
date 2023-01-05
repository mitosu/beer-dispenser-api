<?php

declare(strict_types=1);

namespace App\Entity\Exception\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'User not found';

    public static function fromEmail()
    {
        throw new self(self::MESSAGE);
    }
}