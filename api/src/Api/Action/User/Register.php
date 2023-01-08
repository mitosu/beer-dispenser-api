<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Entity\User;
use App\Services\User\UserRegistrationService;
use Symfony\Component\HttpFoundation\Request;

class Register
{
    private UserRegistrationService $userRegistrationService;
    public function __construct(UserRegistrationService $userRegistrationService)
    {
        $this->userRegistrationService = $userRegistrationService;
    }

    public function __invoke(Request $request): User
    {
        return $this->userRegistrationService->create($request);
    }
}