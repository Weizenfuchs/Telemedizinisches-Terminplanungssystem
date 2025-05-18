<?php

declare(strict_types=1);

namespace Infrastructure;

use Domain\Doctor\DoctorRepositoryInterface;
use Domain\Doctor\SpecializationRepositoryInterface;
use Infrastructure\Hydrator\DoctorHydrator;
use Infrastructure\Hydrator\DoctorHydratorFactory;
use Infrastructure\Hydrator\SpecializationHydrator;
use Infrastructure\Persistence\Doctor\DoctorRepository;
use Infrastructure\Persistence\Doctor\DoctorRepositoryFactory;
use Infrastructure\Persistence\Doctor\SpecializationRepositoryFactory;
use Infrastructure\Persistence\Doctor\SpecializationRepository;
use Infrastructure\Service\DatabaseService;
use Infrastructure\Service\DatabaseServiceFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'invokables' => [
                    SpecializationHydrator::class => SpecializationHydrator::class,
                ],
                'aliases' => [
                    DoctorRepositoryInterface::class => DoctorRepository::class,
                    SpecializationRepositoryInterface::class => SpecializationRepository::class,
                ],
                'factories' => [
                    DatabaseService::class => DatabaseServiceFactory::class,
                    DoctorRepository::class => DoctorRepositoryFactory::class,
                    SpecializationRepository::class => SpecializationRepositoryFactory::class,
                    DoctorHydrator::class => DoctorHydratorFactory::class,
                ],
            ],
        ];
    }
}
