<?php

namespace App\Tests\User\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserName;
use InvalidArgumentException;

class UserNameTest extends TestCase
{
    public function testCreationUserNameValueObject(): void
    {
        $name = new UserName('Miguel Angel');
        $this->assertEquals('Miguel Angel', $name->value());
    }

    public function testExceptionWhenNameIsNotMinimunLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $name = new UserName('Mi');
    }
}
