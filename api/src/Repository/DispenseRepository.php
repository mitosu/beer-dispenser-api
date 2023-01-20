<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Dispense;
use Doctrine\ORM\ORMException;
use App\Entity\Exception\Dispense\DispenseNotFoundException;

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

    public function findOneByIdOrFail(string $id): Dispense
    {
        if (null === $dispense = $this->objectRepository->find($id)) {
            DispenseNotFoundException::fromId();
        }

        return $dispense;
    }

    public function findOneByIdAndStatusOrFail(string $dispenserId, bool $status)
    {
        $dispense = $this->executeFetchQuery(
            'SELECT * FROM dispense WHERE dispenser_id = :dispenser_id AND status = :status',
            ['dispenser_id' => $dispenserId, 'status' => $status]
        );
        
        if (is_null($dispense) ) {
            DispenseNotFoundException::fromIdAndStatus();
        }

        return $dispense;
    }
}