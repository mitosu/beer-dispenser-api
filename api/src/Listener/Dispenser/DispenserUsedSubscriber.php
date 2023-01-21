<?php

declare(strict_types=1);

namespace App\Listener\Dispenser;

use App\Event\Dispenser\DispenserUsedEvent;
use App\Repository\DispenserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\Dispenser;
use App\Services\Sale\SaleRegisterService;
class DispenserUsedSubscriber implements EventSubscriberInterface
{
    private DispenserRepository $dispenserRepository;
    private SaleRegisterService $saleReisterService;
    private int $litersSold;
    private int $secondsUsed;
    public function __construct(DispenserRepository $dispenserRepository, SaleRegisterService $saleRegisterService)
    {
        $this->dispenserRepository = $dispenserRepository;
        $this->saleReisterService = $saleRegisterService;
    }
    /**
     * Summary of getSubscribedEvents
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [DispenserUsedEvent::NAME => [
            ['updateAmount', 10],
            ['registerSale', 9],
        ]];
    }

    /**
     * Summary of registerSale
     * @param DispenserUsedEvent $event
     * @return void
     */
    public function registerSale(DispenserUsedEvent $event): void
    {
        $dispenser = $this->dispenserRepository->findOneByIdOrFail(
            $event->getDispenserId()
        );

        $this->litersSold = intval($this->calculateLitersSold($event, $dispenser));

        $this->saleReisterService->register($event->getDispenserId(), $this->litersSold, $this->secondsUsed);
    }

    /**
     * Summary of updateAmount
     * @param DispenserUsedEvent $event
     * @return void
     */
    public function updateAmount(DispenserUsedEvent $event): void
    {
        $dispenser = $this->dispenserRepository->findOneByIdOrFail(
            $event->getDispenserId()
        );

        $litersSold = $this->calculateLitersSold($event, $dispenser);

        $dispenser->decreaaseUpdateAmount($litersSold);

        $this->dispenserRepository->save($dispenser);
    }
    /**
     * Summary of calculateLitersSold
     * @param mixed $event
     * @param Dispenser $dispenser
     * @return float
     */
    private function calculateLitersSold($event, Dispenser $dispenser): int
    {
        $this->secondsUsed = intval($event->getClosed()->getTimestamp() - $event->getOpened()->getTimestamp());
        return $this->secondsUsed * $dispenser->getDispenserFlowVolume();
        
    }
}