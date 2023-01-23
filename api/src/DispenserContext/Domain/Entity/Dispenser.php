<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity;

use App\DispenserContext\Domain\Entity\ValueObjects\Dispenser\DispenserFlowVolume;
use App\DispenserContext\Domain\Entity\ValueObjects\Dispenser\DispenserAmount;
use App\DispenserContext\Domain\Entity\ValueObjects\Dispenser\DispenserStatus;
use App\DispenserContext\Domain\Entity\ValueObjects\Id\GenerateId;
use DateTime;

class Dispenser
{
    private string $id;
    private int $dispenserFlowVolume;
    private int $dispenserAmount;
    private bool $dispenserStatus;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $dispenserFlowVolume, int $dispenserAmount)
    {
        $id = new GenerateId();
        $flowVolume = new DispenserFlowVolume($dispenserFlowVolume);
        $amount = new DispenserAmount($dispenserAmount);
        $status = new DispenserStatus(false);

        $this->id = $id->value();
        $this->dispenserFlowVolume = $flowVolume->value();
        $this->dispenserAmount = $amount->value();
        $this->dispenserStatus = $status->value();
        $this->createdAt = new DateTime();
        $this->updatedAt = $this->updatedAt();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDispenserFlowVolume(): int
    {
        return $this->dispenserFlowVolume;
    }

    public function getDispenserAmount(): int
    {
        return $this->dispenserAmount;
    }

    public function getDispenserStatus(): bool
    {
        return $this->dispenserStatus;
    }

    public function dispenserStatus(bool $status): void
    {
        $this->dispenserStatus = $status;
    }

    public function decreaaseUpdateAmount($aAmount): void
    {
        $amount = new DispenserAmount($this->dispenserAmount);
        $updatedAmount = $amount->decreaseAmountBy($aAmount);
        $this->dispenserAmount = $updatedAmount->value();
    }

    public function updatedAt(): DateTime
    {
        return new DateTime();
    }
}