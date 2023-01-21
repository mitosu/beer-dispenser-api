<?php

declare(strict_types=1);

namespace App\Services\Sale;

use App\Entity\Sale;
use App\Repository\SaleRepository;
use Exception;
class SaleRegisterService
{
    private SaleRepository $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function register(string $dispenserId, int $liters, int $seconds): Sale
    {
        $sale = new Sale($dispenserId, $liters, $seconds);

        try {
            $this->saleRepository->save($sale);
        } catch (Exception $e) {
            //
        }

        return $sale;
    }
}