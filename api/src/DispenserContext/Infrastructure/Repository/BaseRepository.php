<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Repository;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\Mapping\MappingException;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
abstract class BaseRepository
{
    private ManagerRegistry $managerRegistry;
    protected Connection $connection;
    protected ObjectRepository $objectRepository;

    public function __construct(ManagerRegistry $managerRegistry, Connection $connection)
    {
        $this->managerRegistry = $managerRegistry;
        $this->connection = $connection;
        $this->objectRepository = $this->getEntityManager()->getRepository($this->entityClass());
    }

    abstract protected static function entityClass(): string;
    
    /**
     * persistEntity
     * @throws \Doctrine\ORM\ORMException
     * @return void
     */
    public function persistEntity(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws MappingException
     * @return void
     */
    public function flushData(): void
    {
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }
    
    /**
     * saveEntity
     * @throws ORMException
     * @throws OptimisticlockException
     * @return void
     */
    public function saveEntity(object $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
    
    /**
     * removeEntity
     * @throws ORMException
     * @throws OptimisticlockException
     * @return void
     */
    public function removeEntity(object $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
    
    /**
     * executeFetchQuery
     * @throws DBALException
     * @param  mixed $query
     * @param  mixed $params
     * @return array
     */
    protected function executeFetchQuery(string $query, $params = []): array
    {
        return $this->connection->executeQuery($query, $params)->fetchAllAssociative();
    }
    
    /**
     * executeQuery
     * @throws DBALException
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    protected function executeQuery(string $query, array $params = []): void
    {
        $this->connection->executeQuery($query, $params);
    }

    /**
     * Summary of getEntityManager
     * @return ObjectManager|EntityManager
     */
    private function getEntityManager()
    {
        $entityManager = $this->managerRegistry->getManager();

        if ($entityManager->isOpen()) {
            return $entityManager;
        }

        return $this->managerRegistry->resetManager();
    }
}