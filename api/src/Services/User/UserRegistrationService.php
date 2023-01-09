<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Password\EncryptionService;
use App\Services\Request\RequestService;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Exception\User\UserAlreadyCreatedException;

class UserRegistrationService
{
    private UserRepository $userRepository;
    private EncryptionService $encryptionService;
    public function __construct(UserRepository $userRepository, EncryptionService $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    public function create(Request $request): User
    {
        $name = RequestService::getField($request, 'name');
        $email = RequestService::getField($request, 'email');
        $password = RequestService::getField($request, 'password');

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