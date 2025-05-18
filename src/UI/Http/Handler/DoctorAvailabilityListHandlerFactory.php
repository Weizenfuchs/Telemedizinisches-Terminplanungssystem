<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Availability\Service\DoctorAvailabilityService;
use Psr\Container\ContainerInterface;
use UI\Http\Extractor\AvailabilityExtractor;

final class DoctorAvailabilityListHandlerFactory
{
    public function __invoke(ContainerInterface $container): DoctorAvailabilityListHandler
    {
        return new DoctorAvailabilityListHandler(
            $container->get(DoctorAvailabilityService::class),
            $container->get(AvailabilityExtractor::class)
        );
    }
}
