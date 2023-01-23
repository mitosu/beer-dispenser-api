<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Repository;

use App\DispenserContext\Domain\Entity\Exception\User\UserNotFoundException;
use App\DispenserContext\Domain\Entity\User;
use Doctrine\ORM\ORMException;

class UserRepository extends BaseRepository
{
    /**
     * entityClass
     *
     * @return string
     */
    protected static function entityClass(): string 
    {
        return User::class;
    }
    
    /**
     * findUserByEmail
     *
     * @param  string $email
     * @return User
     */
    public function findUserByEmail(string $email): User
    {
        if (null === $user = $this->objectRepository()->findOneBy(['email' => $email])) {
            throw new UserNotFoundException();
        }

        return $user;
    }
    
    /**
     * save
     *
     * @param  User $user
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @return void
     */
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }
    
    /**
     * remove
     *
     * @param  User $user
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @return void
     */
    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }
}