<?php

namespace App\Tests\Services\Dispense;

use App\Entity\Dispense;
use App\Entity\User;
use App\Entity\Dispenser;
use App\Repository\DispenseRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OpenServiceTest extends KernelTestCase
{
    private DispenseRepository $dispenseRepository;
    protected function setUp(): void
    {
        self::bootKernel();
        $this->dispenseRepository = static::getContainer()->get('App\Repository\DispenseRepository');
    }
    public function testOpenDispenser(): void
    {
        $dispenser = new Dispenser(1, 50);
        $user = new User('Miguel Torres', 'migueltorres@mail.com');
        
        $dispense = new Dispense($dispenser->getDispenserId(), $user->getId());
        $dispense->dispenseStatus(true);

        $this->dispenseRepository->save($dispense);
        $newDispense = $this->dispenseRepository->findOneByIdOrFail($dispense->getId());

        $this->assertEquals($dispense->getId(), $newDispense->getId());
        $this->assertTrue($newDispense->getStatus());
    }
}