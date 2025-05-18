<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\SpecializationRepositoryInterface;
use Infrastructure\Hydrator\SpecializationHydrator;
use Infrastructure\Persistence\Doctor\SpecializationRepository;
use Infrastructure\Service\DatabaseService;
use Psr\Container\ContainerInterface;

final class SpecializationRepositoryFactory
{
    public function __invoke(ContainerInterface $container): SpecializationRepositoryInterface
    {
        $dbService = $container->get(DatabaseService::class);
        $specializationHydrator = $container->get(SpecializationHydrator::class);

        return new SpecializationRepository($dbService, $specializationHydrator);
    }
}
