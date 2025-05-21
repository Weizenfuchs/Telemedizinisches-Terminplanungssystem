<?php

declare(strict_types=1);

namespace Domain\Appointment\Service;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Service\DeleteAppointment;
use Psr\Container\ContainerInterface;

final class DeleteAppointmentFactory
{
    public function __invoke(ContainerInterface $container): DeleteAppointment
    {
        return new DeleteAppointment(
            $container->get(AppointmentRepositoryInterface::class),
        );
    }
}
