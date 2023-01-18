<?php

declare(strict_types=1);

namespace App\Services\Dispense;

use App\Entity\Dispense;
use App\Repository\DispenseRepository;
use Exception;
use App\Services\Dispenser\DispenserUpdateStatus;

class DispenseCloseService
{
    private DispenseRepository $dispenseRepository;
    private DispenserUpdateStatus $dispenserUpdateStatusService;
    public function __construct(DispenseRepository $dispenseRepository, DispenserUpdateStatus $dispenserUpdateStatus)
    {
        $this->dispenseRepository = $dispenseRepository;
        $this->dispenserUpdateStatusService = $dispenserUpdateStatus;
    }

    public function close(string $dispenserId, string $userId): Dispense
    {
        $dispense = new Dispense($dispenserId, $userId);
        $dispense->dispenseStatus(false);

        $this->dispenserUpdateStatusService->update($dispenserId, false);
        try {
            $this->dispenseRepository->save($dispense);
        } catch (Exception $e) {
            //
        }

        return $dispense;
    }
}