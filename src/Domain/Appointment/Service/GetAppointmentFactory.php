<?php

declare(strict_types=1);

namespace Domain\Appointment\Service;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Service\GetAppointment;
use Psr\Container\ContainerInterface;

final class GetAppointmentFactory
{
    public function __invoke(ContainerInterface $container): GetAppointment
    {
        return new GetAppointment(
            $container->get(AppointmentRepositoryInterface::class),
        );
    }
}
