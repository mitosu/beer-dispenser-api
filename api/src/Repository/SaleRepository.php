<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Sale;
use Doctrine\ORM\ORMException;
use App\Entity\Exception\Dispenser\DispenserNotFoundException;

class SaleRepository extends BaseRepository
{
    /**
     * entityClass
     * @return string
     */
    protected static function entityClass(): string
    {
        return Sale::class;
    }

    /**
     * saveEntity
     * @param Sale $dispenser
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticlockException
     * @return void
     */
    public function save(Sale $sale): void
    {
        $this->saveEntity($sale);
    }

    public function getByDispenserId(string $dispenserId)
    {
        $sales = $this->executeFetchQuery(
            'SELECT * FROM sale WHERE dispenser_id = :dispenser_id',
            ['dispenser_id' => $dispenserId]
        );
        
        if (is_null($sales) ) {
            DispenserNotFoundException::fromId();
        }

        return $sales;
    }
}