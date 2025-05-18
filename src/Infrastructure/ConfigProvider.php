<?php

declare(strict_types=1);

namespace Infrastructure;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Doctor\DoctorRepositoryInterface;
use Domain\Doctor\SpecializationRepositoryInterface;
use Domain\TimeSlot\TimeSlotRepositoryInterface;
use Infrastructure\Hydrator\AppointmentHydrator;
use Infrastructure\Hydrator\TimeSlotHydrator;
use Infrastructure\Persistence\Appointment\AppointmentRepositoryFactory;
use Infrastructure\Persistence\Appointment\AppointmentRepository;
use Infrastructure\Persistence\TimeSlot\TimeSlotRepositoryFactory;
use Infrastructure\Hydrator\DoctorHydrator;
use Infrastructure\Hydrator\DoctorHydratorFactory;
use Infrastructure\Hydrator\SpecializationHydrator;
use Infrastructure\Persistence\Doctor\DoctorRepository;
use Infrastructure\Persistence\Doctor\DoctorRepositoryFactory;
use Infrastructure\Persistence\Doctor\SpecializationRepositoryFactory;
use Infrastructure\Persistence\Doctor\SpecializationRepository;
use Infrastructure\Persistence\TimeSlot\TimeSlotRepository;
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
                    TimeSlotHydrator::class => TimeSlotHydrator::class,
                    AppointmentHydrator::class => AppointmentHydrator::class,
                ],
                'aliases' => [
                    DoctorRepositoryInterface::class => DoctorRepository::class,
                    SpecializationRepositoryInterface::class => SpecializationRepository::class,
                    TimeSlotRepositoryInterface::class => TimeSlotRepository::class,
                    AppointmentRepositoryInterface::class => AppointmentRepository::class,
                ],
                'factories' => [
                    DatabaseService::class => DatabaseServiceFactory::class,
                    DoctorRepository::class => DoctorRepositoryFactory::class,
                    SpecializationRepository::class => SpecializationRepositoryFactory::class,
                    TimeSlotRepository::class => TimeSlotRepositoryFactory::class,
                    DoctorHydrator::class => DoctorHydratorFactory::class,
                    AppointmentRepository::class => AppointmentRepositoryFactory::class,
                ],
            ],
        ];
    }
}
