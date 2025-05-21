<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Appointment\Service\DeleteAppointment;
use Psr\Container\ContainerInterface;

final class DeleteAppointmentHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeleteAppointmentHandler
    {
        return new DeleteAppointmentHandler(
            $container->get(DeleteAppointment::class),
        );
    }
}
