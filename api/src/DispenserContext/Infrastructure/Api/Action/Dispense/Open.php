<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Api\Action\Dispense;

use App\DispenserContext\Domain\Entity\Dispense;
use Symfony\Component\HttpFoundation\Request;
use App\DispenserContext\Application\Services\Dispense\DispenseOpenService;
use App\DispenserContext\Application\Services\Request\RequestService;

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