<?php

declare(strict_types=1);

namespace App\Api\Action\Dispenser;

use App\Entity\Dispenser;
use App\Services\Dispenser\DispenserFindService;
use Symfony\Component\HttpFoundation\Request;

class Find
{
    private DispenserFindService $dispenserFindService;

    public function __construct(DispenserFindService $dispenserFindService)
    {
        $this->dispenserFindService = $dispenserFindService;
    }

    public function __invoke(Request $request)
    {
        return $this->dispenserFindService->find($request);
    }
}