<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Appointment\Service\CreateAppointment;
use Psr\Container\ContainerInterface;

final class CreateAppointmentHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateAppointmentHandler
    {
        return new CreateAppointmentHandler(
            $container->get(CreateAppointment::class),
        );
    }
}
