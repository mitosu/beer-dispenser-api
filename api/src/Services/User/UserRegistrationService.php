<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserRegistrationService
{
    public function __construct()
    {
        
    }

    public function create(Request $request): User
    {
        //
    }
}