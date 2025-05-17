<?php

declare(strict_types=1);

namespace Ui;

use Domain\Doctor\DoctorRepositoryInterface;
use Infrastructure\Persistence\Doctor\DoctorRepository;
use Infrastructure\Persistence\Doctor\DoctorRepositoryFactory;
use UI\Http\Handler\DoctorListHandler;
use UI\Http\Handler\DoctorListHandlerFactory;
use UI\Http\Handler\HomePageHandlerFactory;
use UI\Http\Handler\PingHandler;
use UI\Http\Handler\HomePageHandler;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                PingHandler::class => PingHandler::class,
            ],
            'aliases' => [
                DoctorRepositoryInterface::class => DoctorRepository::class,
            ],
            'factories'  => [
                HomePageHandler::class => HomePageHandlerFactory::class,
                DoctorListHandler::class => DoctorListHandlerFactory::class,
                DoctorRepository::class => DoctorRepositoryFactory::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
