<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Api\Action\Sale;

use App\DispenserContext\Domain\Entity\Sale;
use App\DispenserContext\Application\Services\Sale\SaleFindService;
use Symfony\Component\HttpFoundation\Request;
use App\DispenserContext\Application\Services\Request\RequestService;

class Find
{
    private SaleFindService $saleFindService;

    public function __construct(SaleFindService $saleFindService)
    {
        $this->saleFindService = $saleFindService;
    }

    public function __invoke(Request $request)
    {
        $dispenserId = RequestService::getField($request, 'dispenserId');
        return $this->saleFindService->find($dispenserId);
    }
}