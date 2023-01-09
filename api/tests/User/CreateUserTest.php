<?php

namespace App\Tests\User;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class CreateUserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $user = new User('Miguel Angel', 'miguelangel@mail.com');
        $this->assertInstanceOf(User::class, $user);
    }
}
