<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObjects\Sale\SaleId;
use DateTime;

class Sale
{
    private string $saleId;
    private string $dispenserId;
    private int $litersSold;
    private int $secondsUsed;
    private DateTime $createdAt;

    public function __construct(string $dispenserId, int $litersSold, int $secondsUsed)
    {
        $saleId = new SaleId();

        $this->saleId = $saleId->value();
        $this->dispenserId = $dispenserId;
        $this->litersSold = $litersSold;
        $this->secondsUsed = $secondsUsed;
        $this->createdAt = new DateTime();
    }

    public function getSaleId(): string
    {
        return $this->saleId;
    }

    public function getDispenserId(): string
    {
        return $this->dispenserId;
    }

    public function getLitersSold(): int
    {
        return $this->litersSold;
    }

    public function getSecondsUsed(): int
    {
        return $this->secondsUsed;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}