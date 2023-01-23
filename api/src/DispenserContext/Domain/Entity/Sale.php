<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity;

use App\DispenserContext\Domain\Entity\ValueObjects\Id\GenerateId;
use DateTime;

class Sale
{
    private string $id;
    private string $dispenserId;
    private int $litersSold;
    private int $secondsUsed;
    private DateTime $createdAt;

    public function __construct(string $dispenserId, int $litersSold, int $secondsUsed)
    {
        $saleId = new GenerateId();

        $this->id = $saleId->value();
        $this->dispenserId = $dispenserId;
        $this->litersSold = $litersSold;
        $this->secondsUsed = $secondsUsed;
        $this->createdAt = new DateTime();
    }

    public function getId(): string
    {
        return $this->id;
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