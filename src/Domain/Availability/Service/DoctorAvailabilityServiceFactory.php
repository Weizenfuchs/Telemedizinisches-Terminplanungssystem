<?php

declare(strict_types=1);

namespace Domain\Availability\Service;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\TimeSlot\TimeSlotRepositoryInterface;
use Psr\Container\ContainerInterface;

final class DoctorAvailabilityServiceFactory
{
    public function __invoke(ContainerInterface $container): DoctorAvailabilityService
    {
        return new DoctorAvailabilityService(
            $container->get(TimeSlotRepositoryInterface::class),
            $container->get(AppointmentRepositoryInterface::class),
        );
    }
}
