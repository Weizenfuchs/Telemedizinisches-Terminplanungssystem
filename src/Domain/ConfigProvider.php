<?php

declare(strict_types=1);

namespace Domain;

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
                ],
            ],
        ];
    }
}
