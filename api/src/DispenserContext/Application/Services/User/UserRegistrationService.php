<?php

declare(strict_types=1);

namespace App\DispenserContext\Application\Services\User;

use App\DispenserContext\Domain\Entity\User;
use App\DispenserContext\Infrastructure\Repository\UserRepository;
use App\DispenserContext\Application\Services\Password\EncryptionService;
use Exception;
use App\DispenserContext\Domain\Entity\Exception\User\UserAlreadyCreatedException;

class UserRegistrationService
{
    private UserRepository $userRepository;
    private EncryptionService $encryptionService;
    public function __construct(UserRepository $userRepository, EncryptionService $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    public function create(string $name, string $email, string $password): User
    {
        $user = new User($name, $email);

        $user->setPassword($this->encryptionService->generatePasswordHashed($user, $password));

        try {
            $this->userRepository->save($user);
        } catch (Exception $e) {
            throw UserAlreadyCreatedException::userAlreadyStored($email);
        }

        return $user;
    }
}