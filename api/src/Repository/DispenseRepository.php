<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Dispense;
use Doctrine\ORM\ORMException;

class DispenseRepository extends BaseRepository
{
    /**
     * entityClass
     * @return string
     */
    protected static function entityClass(): string
    {
        return Dispense::class;
    }

    /**
     * saveEntity
     * @param Dispense $dispenser
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticlockException
     * @return void
     */
    public function save(Dispense $dispense): void
    {
        $this->saveEntity($dispense);
    }
}