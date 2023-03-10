<?php

declare(strict_types=1);

namespace App\DispenserContext\Application\Services\Dispenser;

use App\DispenserContext\Domain\Entity\Dispenser;
use App\DispenserContext\Domain\Entity\Exception\Dispenser\DispenserUpdateStatusFailException;
use App\DispenserContext\Infrastructure\Repository\DispenserRepository;
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