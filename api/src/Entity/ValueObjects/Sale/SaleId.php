<?php

declare(strict_types=1);

namespace App\Entity\ValueObjects\Sale;

use Symfony\Component\Uid\Uuid;

final class SaleId
{
    private $value;

    public function __construct()
    {
        $this->value = Uuid::v4()->toRfc4122();
    }

    public function value(): string
    {
        return $this->value;
    }
}