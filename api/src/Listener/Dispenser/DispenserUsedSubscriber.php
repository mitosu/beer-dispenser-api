<?php

declare(strict_types=1);

namespace App\Listener\Dispenser;

use App\Event\Dispenser\DispenserUsedEvent;
use App\Repository\DispenserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\Dispenser;
class DispenserUsedSubscriber implements EventSubscriberInterface
{
    private DispenserRepository $dispenserRepository;
    public function __construct(DispenserRepository $dispenserRepository)
    {
        $this->dispenserRepository = $dispenserRepository;
    }
    public static function getSubscribedEvents(): array
    {
        return [DispenserUsedEvent::NAME => [
            ['updateAmount', 10],//9
            //['updateStatus', 10],
        ]];
    }

    public function updateStatus(DispenserUsedEvent $event): void
    {
        //
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
    private function calculateLitersSold($event, Dispenser $dispenser)
    {
        $secondsDispensed = $event->getClosed()->getTimestamp() - $event->getOpened()->getTimestamp();
        return $secondsDispensed * $dispenser->getDispenserFlowVolume();
        
    }
}