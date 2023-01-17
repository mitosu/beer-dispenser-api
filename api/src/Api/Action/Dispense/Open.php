<?php

declare(strict_types=1);

namespace App\Api\Action\Dispense;

use App\Entity\Dispense;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Dispense\DispenseOpenService;

class Open
{
    private DispenseOpenService $dispenseOpenService;
    public function __construct(DispenseOpenService $dispenseOpenService)
    {
        $this->dispenseOpenService = $dispenseOpenService;
    }

    public function __invoke(Request $request): Dispense
    {
        return $this->dispenseOpenService->open($request);
    }
}