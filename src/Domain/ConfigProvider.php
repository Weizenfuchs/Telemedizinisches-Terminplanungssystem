<?php

declare(strict_types=1);

namespace Domain;

use Domain\Appointment\Service\CreateAppointment;
use Domain\Appointment\Service\CreateAppointmentFactory;
use Domain\Appointment\Service\DeleteAppointment;
use Domain\Appointment\Service\DeleteAppointmentFactory;
use Domain\Appointment\Service\GetAppointment;
use Domain\Appointment\Service\GetAppointmentFactory;
use Domain\Availability\Service\DoctorAvailabilityService;
use Domain\Availability\Service\DoctorAvailabilityServiceFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    DoctorAvailabilityService::class => DoctorAvailabilityServiceFactory::class,
                    CreateAppointment::class => CreateAppointmentFactory::class,
                    DeleteAppointment::class => DeleteAppointmentFactory::class,
                    GetAppointment::class => GetAppointmentFactory::class,
                ],
            ],
        ];
    }
}
