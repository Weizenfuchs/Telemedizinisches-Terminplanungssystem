<?php

declare(strict_types=1);

namespace Infrastructure;

use Domain\Doctor\DoctorRepositoryInterface;
use Infrastructure\Persistence\Doctor\DoctorRepository;
use Infrastructure\Persistence\Doctor\DoctorRepositoryFactory;
use Infrastructure\Service\DatabaseService;
use Infrastructure\Service\DatabaseServiceFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases' => [
                    DoctorRepositoryInterface::class => DoctorRepository::class,
                ],
                'factories' => [
                    DatabaseService::class => DatabaseServiceFactory::class,
                    DoctorRepository::class => DoctorRepositoryFactory::class,
                ],
            ],
        ];
    }
}
