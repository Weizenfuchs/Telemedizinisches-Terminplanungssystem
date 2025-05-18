<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Appointment;

use Domain\Appointment\AppointmentRepositoryInterface;
use Infrastructure\Hydrator\AppointmentHydrator;
use Infrastructure\Persistence\Appointment\AppointmentRepository;
use Infrastructure\Service\DatabaseService;
use Psr\Container\ContainerInterface;

final class AppointmentRepositoryFactory
{
    public function __invoke(ContainerInterface $container): AppointmentRepositoryInterface
    {
        $databaseService = $container->get(DatabaseService::class);
        $appointmentHydrator = $container->get(AppointmentHydrator::class);

        return new AppointmentRepository($databaseService, $appointmentHydrator);
    }
}
