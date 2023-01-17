<?php

declare(strict_types=1);

namespace App\Api\Action\Dispense;

use App\Entity\Dispense;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Dispense\DispenseCloseService;

class Close
{
    private DispenseCloseService $dispenseCloseService;
    public function __construct(DispenseCloseService $dispenseCloseService)
    {
        $this->dispenseCloseService = $dispenseCloseService;
    }

    public function __invoke(Request $request): Dispense
    {
        return $this->dispenseCloseService->close($request);
    }
}