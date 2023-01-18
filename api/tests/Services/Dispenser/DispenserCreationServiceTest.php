<?php

namespace App\Tests\Services\Dispenser;

use App\Entity\Dispenser;
use App\Repository\DispenserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DispenserCreationServiceTest extends KernelTestCase
{
    private DispenserRepository $dispenserRepository;
    protected function setUp(): void
    {
        self::bootKernel();
        $this->dispenserRepository = static::getContainer()->get('App\Repository\DispenserRepository');

    }
    public function testCreationDispenser(): void
    {
        $dispenser = new Dispenser(1, 50);
        
        $this->dispenserRepository->save($dispenser);
        $newDispenser = $this->dispenserRepository->findOneByIdOrFail($dispenser->getDispenserId());

        $this->assertEquals($dispenser->getDispenserId(), $newDispenser->getDispenserId());
    }
}
