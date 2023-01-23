<?php

declare(strict_types=1);

namespace App\DispenserContext\Application\Services\Sale;

use App\DispenserContext\Domain\Entity\Sale;
use App\DispenserContext\Infrastructure\Repository\SaleRepository;
use Exception;

class SaleFindService
{
    private SaleRepository $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function find(string $saleId): Sale
    {
        try {
        return $this->saleRepository->findOneByIdOrFail($saleId);
        } catch(Exception $e) {
            //
        }
    }
}