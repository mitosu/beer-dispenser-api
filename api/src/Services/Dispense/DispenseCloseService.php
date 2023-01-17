<?php

declare(strict_types=1);

namespace App\Services\Dispense;

use App\Entity\Dispense;
use App\Repository\DispenseRepository;
use App\Services\Request\RequestService;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class DispenseCloseService
{
    private DispenseRepository $dispenseRepository;
    public function __construct(DispenseRepository $dispenseRepository)
    {
        $this->dispenseRepository = $dispenseRepository;
    }

    public function close(Request $request): Dispense
    {
        $dispenserId = RequestService::getField($request, 'dispenserId');
        $userId = RequestService::getField($request, 'userId');

        $dispense = new Dispense($dispenserId, $userId);
        $dispense->dispenseStatus(false);

        try {
            $this->dispenseRepository->save($dispense);
        } catch (Exception $e) {
            //
        }

        return $dispense;
    }
}