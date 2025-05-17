<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\DoctorRepositoryInterface;
use Infrastructure\Persistence\Doctor\DoctorRepository;
use Psr\Container\ContainerInterface;

final class DoctorRepositoryFactory
{
    public function __invoke(ContainerInterface $container): DoctorRepositoryInterface
    {
        return new DoctorRepository();
    }
}
