<?php

declare(strict_types=1);

namespace App\Api\Action\Dispenser;

use App\Entity\Dispenser;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class Dispense 
{
    private string $dispenseId;
    private string $dispenserId;
    private DateTime $createdAt;
}