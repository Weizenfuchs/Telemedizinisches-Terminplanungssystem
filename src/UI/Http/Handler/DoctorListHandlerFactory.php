<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Doctor\DoctorRepositoryInterface;
use Psr\Container\ContainerInterface;

final class DoctorListHandlerFactory
{
    public function __invoke(ContainerInterface $container): DoctorListHandler
    {
        return new DoctorListHandler(
            $container->get(DoctorRepositoryInterface::class)
        );
    }
}
