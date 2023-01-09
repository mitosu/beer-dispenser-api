<?php

namespace App\Tests\User\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\Entity\ValueObjects\User\UserEmail;
use InvalidArgumentException;

class UserEmailTest extends TestCase
{
    public function testCreationEmailValueObject(): void
    {
        $email = new UserEmail('miguelangel@gmail.com');
        $this->assertEquals('miguelangel@gmail.com', $email->value());
    }

    public function testExecptionWhenEmailIsNotCorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $email = new UserEmail('miguelangelgmail.com');
    }
}
