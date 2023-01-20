<?php 

declare(strict_types=1);

namespace App\Event\Dispenser;

use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\Dispenser;
use DateTime;

class DispenserUsedEvent extends Event
{
    public const NAME = 'dispenser.used';
    private string $dispenserId;
    private DateTime $opened;
    private DateTime $closed;
    public function __construct(string $dispenserId, DateTime $opened, DateTime $closed)
    {
        $this->dispenserId = $dispenserId;
        $this->opened = $opened;
        $this->closed = $closed;
    }

    public function getDispenserId(): string
    {
        return $this->dispenserId;
    }

    public function getOpened(): DateTime
    {
        return $this->opened;
    }

    public function getClosed(): DateTime
    {
        return $this->closed;
    }
}