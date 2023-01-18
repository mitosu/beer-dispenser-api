<?php

declare(strict_types=1);

namespace App\Services\Dispenser;

use App\Entity\Dispenser;
use App\Entity\Exception\Dispenser\DispenserUpdateStatusFailException;
use App\Repository\DispenserRepository;
use Exception;

class DispenserUpdateStatus
{
    private DispenserRepository $dispenserRepository;

    public function __construct(DispenserRepository $dispenserRepository)
    {
        $this->dispenserRepository = $dispenserRepository;
    }

    public function update(string $dispenserId, bool $newStatus): void
    {
        $dispenser = $this->dispenserRepository->findOneByIdOrFail($dispenserId);
        if ($dispenser->getDispenserStatus() == $newStatus) {
            throw new DispenserUpdateStatusFailException('The current state is '.$newStatus.', and not be set');
        }

        $dispenser->dispenserStatus($newStatus);

        try {
            $this->dispenserRepository->save($dispenser);
        } catch (Exception $e) {
            //
        }
    }
}