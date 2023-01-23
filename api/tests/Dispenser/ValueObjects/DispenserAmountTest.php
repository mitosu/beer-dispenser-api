<?php

namespace App\Tests\Dispenser\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\DispenserContext\Domain\Entity\ValueObjects\Dispenser\DispenserAmount;
use InvalidArgumentException;

class DispenserAmountTest extends TestCase
{
    public function testInmutabilityAmount(): void
    {
        $aAmount = new DispenserAmount(25);
        $otherAmount = $aAmount->decreaseAmountBy(5);

        $this->assertFalse($aAmount === $otherAmount);
    }

    public function testExceptionCreatedAmountWithIncorrectValues(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $anAmount = new DispenserAmount('5');
    }
}
