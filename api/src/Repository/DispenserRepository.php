<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Dispenser;
use Doctrine\ORM\ORMException;

class DispenserRepository extends BaseRepository
{
    /**
     * entityClass
     * @return string
     */
    protected static function entityClass(): string
    {
        return Dispenser::class;
    }

    /**
     * saveEntity
     * @param Dispenser $dispenser
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticlockException
     * @return void
     */
    public function save(Dispenser $dispenser): void
    {
        $this->saveEntity($dispenser);
    }

    /**
     * removeEntity
     * @param Dispenser $dispenser
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticlockException
     * @return void
     */
    public function remove(Dispenser $dispenser): void
    {
        $this->removeEntity($dispenser);
    }
}