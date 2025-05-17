<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\DoctorRepositoryInterface;
use Infrastructure\Hydrator\DoctorHydrator;
use Infrastructure\Persistence\Doctor\DoctorRepository;
use Infrastructure\Service\DatabaseService;
use Psr\Container\ContainerInterface;

final class DoctorRepositoryFactory
{
    public function __invoke(ContainerInterface $container): DoctorRepositoryInterface
    {
        $dbService = $container->get(DatabaseService::class);
        $doctorHydrator = $container->get(DoctorHydrator::class);

        return new DoctorRepository($dbService, $doctorHydrator);
    }
}
