<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Api\Action\Dispenser;

use App\DispenserContext\Domain\Entity\Dispenser;
use App\DispenserContext\Application\Services\Dispenser\DispenserFindService;
use Symfony\Component\HttpFoundation\Request;
use App\DispenserContext\Application\Services\Request\RequestService;

class Find
{
    private DispenserFindService $dispenserFindService;

    public function __construct(DispenserFindService $dispenserFindService)
    {
        $this->dispenserFindService = $dispenserFindService;
    }

    public function __invoke(Request $request)
    {
        $dispenserId = RequestService::getField($request, 'dispenserId');
        return $this->dispenserFindService->find($dispenserId);
    }
}