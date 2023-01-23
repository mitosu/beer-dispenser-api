<?php

declare(strict_types=1);

namespace App\DispenserContext\Application\Services\Dispenser;

use App\DispenserContext\Domain\Entity\Dispenser;
use App\DispenserContext\Infrastructure\Repository\DispenserRepository;
use Exception;

class DispenserCreationService
{
    private DispenserRepository $dispenserRepository;
    public function __construct(DispenserRepository $dispenserRepository)
    {
        $this->dispenserRepository = $dispenserRepository;
    }

    public function create(int $flowVolume, int $amount): Dispenser
    {
        $dispenser = new Dispenser($flowVolume, $amount);

        try {
            $this->dispenserRepository->save($dispenser);
        } catch (Exception $e) {
            //
        }

        return $dispenser;
    }
}