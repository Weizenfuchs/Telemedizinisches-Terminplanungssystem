<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Appointment\Service\GetAppointment;
use Psr\Container\ContainerInterface;

final class GetAppointmentHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAppointmentHandler
    {
        return new GetAppointmentHandler(
            $container->get(GetAppointment::class),
        );
    }
}
