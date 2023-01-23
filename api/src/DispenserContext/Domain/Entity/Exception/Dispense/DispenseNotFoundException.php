<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\Exception\Dispense;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DispenseNotFoundException extends NotFoundHttpException
{
    public static function fromId()
    {
        throw new self('The dispense not found');
    }

    public static function fromIdAndStatus()
    {
        throw new self('The dispense not found');
    }
}