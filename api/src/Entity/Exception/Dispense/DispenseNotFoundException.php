<?php

declare(strict_types=1);

namespace App\Entity\Exception\Dispense;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DispenseNotFoundException extends NotFoundHttpException
{
    public static function fromId()
    {
        throw new self('The dispense not found');
    }
}