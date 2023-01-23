<?php

namespace App\Tests\User\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserPassword;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserPasswordTest extends TestCase
{

    public function testCreationPasswordValueObject(): void
    {
        $password = new UserPassword('123456');
        $this->assertEquals('123456', $password->value());
    }

    public function testExceptionWhenPasswordIsNotMinimunLength(): void
    {
        $this->expectException(BadRequestException::class);
        $password = new UserPassword('123');
    }
}
