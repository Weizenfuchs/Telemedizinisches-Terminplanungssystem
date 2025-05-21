<?php

declare(strict_types=1);

namespace Domain\Appointment\Service;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Service\CreateAppointment;
use Psr\Container\ContainerInterface;

final class CreateAppointmentFactory
{
    public function __invoke(ContainerInterface $container): CreateAppointment
    {
        return new CreateAppointment(
            $container->get(AppointmentRepositoryInterface::class),
        );
    }
}
