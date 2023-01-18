<?php

declare(strict_types=1);

namespace App\Api\Action\Dispense;

use App\Entity\Dispense;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Dispense\DispenseOpenService;
use App\Services\Request\RequestService;

class Open
{
    private DispenseOpenService $dispenseOpenService;
    public function __construct(DispenseOpenService $dispenseOpenService)
    {
        $this->dispenseOpenService = $dispenseOpenService;
    }

    public function __invoke(Request $request): Dispense
    {
        $dispenserId = RequestService::getField($request, 'dispenserId');
        $userId = RequestService::getField($request, 'userId');

        return $this->dispenseOpenService->open($dispenserId, $userId);
    }
}