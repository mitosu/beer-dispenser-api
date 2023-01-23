<?php

declare(strict_types=1);

namespace App\DispenserContext\Application\Services\Password;

use App\DispenserContext\Domain\Entity\ValueObjects\User\UserPassword;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class EncryptionService
{
    private UserPasswordHasherInterface $userPasswordHasherInterface;
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function generatePasswordHashed(UserInterface $user, string $password)
    {
        $password = new UserPassword($password);
        return $this->userPasswordHasherInterface->hashPassword($user, $password->value());

    }
}