<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObjects\Dispenser\DispenserFlowVolume;
use App\Entity\ValueObjects\Dispenser\DispenserAmount;
use App\Entity\ValueObjects\Dispenser\DispenserId;
use App\Entity\ValueObjects\Dispenser\DispenserStatus;
use DateTime;

class Dispenser
{
    private string $dispenserId;
    private int $dispenserFlowVolume;
    private int $dispenserAmount;
    private bool $dispenserStatus;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $dispenserFlowVolume, int $dispenserAmount)
    {
        $id = new DispenserId();
        $flowVolume = new DispenserFlowVolume($dispenserFlowVolume);
        $amount = new DispenserAmount($dispenserAmount);
        $status = new DispenserStatus(false);

        $this->dispenserId = $id->value();
        $this->dispenserFlowVolume = $flowVolume->value();
        $this->dispenserAmount = $amount->value();
        $this->dispenserStatus = $status->value();
        $this->createdAt = new DateTime();
        $this->updatedAt = $this->updatedAt();
    }

    public function dispenserId(): string
    {
        return $this->dispenserId;
    }

    public function dispenserFlowVolume(): int
    {
        return $this->dispenserFlowVolume;
    }

    public function dispenserAmount(): int
    {
        return $this->dispenserAmount;
    }

    public function dispenserStatus(): bool
    {
        return $this->dispenserStatus;
    }

    public function updateAmount($aAmount): int
    {
        $amount = new DispenserAmount($this->dispenserAmount);
        $updatedAmount = $amount->decreaseAmountBy($aAmount);
        return $updatedAmount->value();
    }

    public function updatedAt(): DateTime
    {
        return new DateTime();
    }
}