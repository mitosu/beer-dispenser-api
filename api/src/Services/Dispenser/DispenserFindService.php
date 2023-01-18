<?php

declare(strict_types=1);

namespace App\Services\Dispenser;

use App\Entity\Dispenser;
use App\Repository\DispenserRepository;
use Exception;

class DispenserFindService
{
    private DispenserRepository $dispenserRepository;

    public function __construct(DispenserRepository $dispenserRepository)
    {
        $this->dispenserRepository = $dispenserRepository;
    }

    public function find(string $dispenserId): Dispenser
    {
        try {
        return $this->dispenserRepository->findOneByIdOrFail($dispenserId);
        } catch(Exception $e) {

        }
    }
}