<?php

namespace App\Tests\Services\Dispenser;

use App\Entity\Dispenser;
use App\Repository\DispenserRepository;
use App\Services\Dispenser\DispenserUpdateStatus;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DispenserUpdateStatusServiceTest extends KernelTestCase
{
    private DispenserRepository $dispenserRepository;
    private DispenserUpdateStatus $dispenserUpdateStatus;
    protected function setUp(): void
    {
        self::bootKernel();
        $this->dispenserRepository = static::getContainer()->get('App\Repository\DispenserRepository');
        $this->dispenserUpdateStatus = static::getContainer()->get('App\Services\Dispenser\DispenserUpdateStatus');
    }
    public function testUpdateStatusDispenser(): void
    {
        $dispenser = new Dispenser(1, 50);

        $this->dispenserRepository->save($dispenser);
        $newDispenser = $this->dispenserRepository->findOneByIdOrFail($dispenser->getDispenserId());

        /**When create by detault status is closed */
        $this->assertFalse($newDispenser->getDispenserStatus());

        $newDispenser->dispenserStatus(true);
        $this->dispenserRepository->save($dispenser);

        $updatedDispenser = $this->dispenserRepository->findOneByIdOrFail($dispenser->getDispenserId());
        $this->assertTrue($updatedDispenser->getDispenserStatus());
    }
}
