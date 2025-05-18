<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\TimeSlot;

use Domain\TimeSlot\TimeSlotRepositoryInterface;
use Infrastructure\Hydrator\TimeSlotHydrator;
use Infrastructure\Persistence\TimeSlot\TimeSlotRepository;
use Infrastructure\Service\DatabaseService;
use Psr\Container\ContainerInterface;

final class TimeSlotRepositoryFactory
{
    public function __invoke(ContainerInterface $container): TimeSlotRepositoryInterface
    {
        $databaseService = $container->get(DatabaseService::class);
        $timeSlotHydrator = $container->get(TimeSlotHydrator::class);

        return new TimeSlotRepository($databaseService, $timeSlotHydrator);
    }
}
