<?php

declare(strict_types=1);

namespace App\Services\Dispenser;

use App\Entity\Dispenser;
use App\Repository\DispenserRepository;
use App\Services\Request\RequestService;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class DispenserCreationService
{
    private DispenserRepository $dispenserRepository;
    public function __construct(DispenserRepository $dispenserRepository)
    {
        $this->dispenserRepository = $dispenserRepository;
    }

    public function create(Request $request): Dispenser
    {
        $dispenserFlowVolume = RequestService::getField($request, 'dispenserFlowVolume');
        $dispenserAmount = RequestService::getField($request, 'dispenserAmount');

        $dispenser = new Dispenser($dispenserFlowVolume, $dispenserAmount);

        try {
            $this->dispenserRepository->save($dispenser);
        } catch (Exception $e) {
            //
        }

        return $dispenser;
    }
}