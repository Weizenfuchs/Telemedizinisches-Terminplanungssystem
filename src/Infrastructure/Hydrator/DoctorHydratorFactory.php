<?php

declare(strict_types=1);

namespace Infrastructure\Hydrator;

use Infrastructure\Hydrator\DoctorHydrator;
use Infrastructure\Hydrator\SpecializationHydrator;
use Psr\Container\ContainerInterface;

final class DoctorHydratorFactory
{
    public function __invoke(ContainerInterface $container): DoctorHydrator
    {
        $specializationHydrator = $container->get(SpecializationHydrator::class);

        return new DoctorHydrator($specializationHydrator);
    }
}
