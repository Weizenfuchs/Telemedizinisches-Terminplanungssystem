<?php

declare(strict_types=1);

namespace Ui;

use UI\Http\Extractor\DoctorExtractor;
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
                DoctorExtractor::class => DoctorExtractor::class,
            ],
            'factories'  => [
                HomePageHandler::class => HomePageHandlerFactory::class,
                DoctorListHandler::class => DoctorListHandlerFactory::class,
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
