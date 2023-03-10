<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Repository;

use App\DispenserContext\Domain\Entity\Dispenser;
use App\DispenserContext\Domain\Entity\Exception\Dispenser\DispenserNotFoundException;
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

    public function findOneByIdOrFail(string $id): Dispenser
    {
        if (null === $dispenser = $this->objectRepository->find($id)) {
            DispenserNotFoundException::fromId();
        }

        return $dispenser;
    }
}