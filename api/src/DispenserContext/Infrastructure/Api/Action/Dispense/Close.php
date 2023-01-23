<?php

declare(strict_types=1);

namespace App\DispenserContext\Infrastructure\Api\Action\Dispense;

use App\DispenserContext\Domain\Entity\Dispense;
use Symfony\Component\HttpFoundation\Request;
use App\DispenserContext\Application\Services\Dispense\DispenseCloseService;
use App\DispenserContext\Application\Services\Request\RequestService;
use App\DispenserContext\Domain\Event\Dispenser\DispenserUsedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\DispenserContext\Infrastructure\Repository\DispenseRepository;
use DateTime;

class Close
{
    private DispenseCloseService $dispenseCloseService;
    private EventDispatcherInterface $eventDispacherInterface;
    private DispenseRepository $dispenseRepository;
    public function __construct(
        DispenseCloseService $dispenseCloseService,
        EventDispatcherInterface $eventDispatcherInterface,
        DispenseRepository $dispenseRepository
        )
    {
        $this->dispenseCloseService = $dispenseCloseService;
        $this->eventDispacherInterface = $eventDispatcherInterface;
        $this->dispenseRepository = $dispenseRepository;
    }

    public function __invoke(Request $request): Dispense
    {
        $dispenserId = RequestService::getField($request, 'dispenserId');
        $userId = RequestService::getField($request, 'userId');


        $dispenseOpen = $this->dispenseRepository->findOneByIdAndStatusOrFail($dispenserId, true);

        $dispenseClosed = $this->dispenseCloseService->close($dispenserId, $userId);

        $this->dispatchEvent($dispenserId, $dispenseOpen, $dispenseClosed);

        return $dispenseClosed;
    }

    /**
     * Summary of dispatchEvent
     * @param string $dispenserId
     * @param mixed $dispenseOpen
     * @param mixed $dispenseClosed
     * @return void
     */
    private function dispatchEvent(string $dispenserId, $dispenseOpen, $dispenseClosed)
    {
        $this->eventDispacherInterface->dispatch(
            new DispenserUsedEvent(
                $dispenserId,
                new DateTime($dispenseOpen[0]['created_at']),
                $dispenseClosed->getCreatedAt()
            ),
            DispenserUsedEvent::NAME
        );
    }
}