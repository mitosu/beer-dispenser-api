<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity;

use App\DispenserContext\Domain\Entity\ValueObjects\Id\GenerateId;
use DateTime;

class Dispense
{
    private string $id;
    private string $dispenserId;
    private string $userId;
    private bool $status;
    private DateTime $createdAt;

    public function __construct(string $dispenserId, string $userId)
    {
        $dispenseId = new GenerateId();
        $this->id = $dispenseId->value();
        $this->dispenserId = $dispenserId;
        $this->userId = $userId;
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

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function dispenseStatus(bool $status)
    {
        $this->status = $status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}