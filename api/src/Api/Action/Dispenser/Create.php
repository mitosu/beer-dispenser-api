<?php

declare(strict_types=1);

namespace App\Api\Action\Dispenser;

use App\Entity\Dispenser;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Dispenser\DispenserCreationService;

class Create
{
    private DispenserCreationService $dispenserCreationService;
    public function __construct(DispenserCreationService $dispenserCreationService)
    {
        $this->dispenserCreationService = $dispenserCreationService;
    }

    public function __invoke(Request $request): Dispenser
    {
        return $this->dispenserCreationService->create($request);
    }
}