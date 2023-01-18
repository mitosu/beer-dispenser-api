<?php

declare(strict_types=1);

namespace App\Services\Dispense;

use App\Entity\Dispense;
use App\Repository\DispenseRepository;
use Exception;
use App\Services\Dispenser\DispenserUpdateStatus;

class DispenseOpenService
{
    private DispenseRepository $dispenseRepository;
    private DispenserUpdateStatus $dispenserUpdateStatusService;
    public function __construct(DispenseRepository $dispenseRepository, DispenserUpdateStatus $dispenserUpdateStatus)
    {
        $this->dispenseRepository = $dispenseRepository;
        $this->dispenserUpdateStatusService = $dispenserUpdateStatus;
    }

    public function open(string $dispenserId, string $userId): Dispense
    {
        $dispense = new Dispense($dispenserId, $userId);
        $dispense->dispenseStatus(true);

        $this->dispenserUpdateStatusService->update($dispenserId, true);
        try {
            $this->dispenseRepository->save($dispense);
        } catch (Exception $e) {
            //
        }

        return $dispense;
    }
}