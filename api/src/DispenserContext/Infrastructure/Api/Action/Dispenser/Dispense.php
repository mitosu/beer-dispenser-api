<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Api\Action\Dispenser;

use App\DispenserContext\Domain\Entity\Dispenser;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class Dispense 
{
    private string $dispenseId;
    private string $dispenserId;
    private DateTime $createdAt;
}