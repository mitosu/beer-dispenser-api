<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\Exception\Dispenser;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DispenserNotFoundException extends NotFoundHttpException
{
    public static function fromId()
    {
        throw new self('The dispenser not found');
    }
}