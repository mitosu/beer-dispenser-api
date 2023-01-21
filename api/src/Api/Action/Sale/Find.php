<?php

declare(strict_types=1);

namespace App\Api\Action\Sale;

use App\Entity\Sale;
use App\Services\Sale\SaleFindService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Request\RequestService;

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