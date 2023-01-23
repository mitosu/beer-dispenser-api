<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Api\Action\Dispenser;

use App\DispenserContext\Domain\Entity\Dispenser;
use Symfony\Component\HttpFoundation\Request;
use App\DispenserContext\Application\Services\Dispenser\DispenserCreationService;
use App\DispenserContext\Application\Services\Request\RequestService;

class Create
{
    private DispenserCreationService $dispenserCreationService;
    public function __construct(DispenserCreationService $dispenserCreationService)
    {
        $this->dispenserCreationService = $dispenserCreationService;
    }

    public function __invoke(Request $request): Dispenser
    {
        $dispenserFlowVolume = RequestService::getField($request, 'dispenserFlowVolume');
        $dispenserAmount = RequestService::getField($request, 'dispenserAmount');

        return $this->dispenserCreationService->create($dispenserFlowVolume, $dispenserAmount);
    }
}