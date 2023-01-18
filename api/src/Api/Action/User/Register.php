<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Entity\User;
use App\Services\User\UserRegistrationService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Request\RequestService;

class Register
{
    private UserRegistrationService $userRegistrationService;
    public function __construct(UserRegistrationService $userRegistrationService)
    {
        $this->userRegistrationService = $userRegistrationService;
    }

    public function __invoke(Request $request): User
    {
        $name = RequestService::getField($request, 'name');
        $email = RequestService::getField($request, 'email');
        $password = RequestService::getField($request, 'password');

        return $this->userRegistrationService->create($name, $email, $password);
    }
}