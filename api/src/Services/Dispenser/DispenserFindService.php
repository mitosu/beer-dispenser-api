<?php

declare(strict_types=1);

namespace App\Services\Dispenser;

use App\Entity\Dispenser;
use App\Repository\DispenserRepository;
use App\Services\Request\RequestService;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class DispenserFindService
{
    private DispenserRepository $dispenserRepository;

    public function __construct(DispenserRepository $dispenserRepository)
    {
        $this->dispenserRepository = $dispenserRepository;
    }

    public function find(Request $request)
    {
        $dispenserId = RequestService::getField($request, 'dispenserId');
        try {
        return $this->dispenserRepository->findOneByIdOrFail($dispenserId);
        } catch(Exception $e) {

        }
    }
}