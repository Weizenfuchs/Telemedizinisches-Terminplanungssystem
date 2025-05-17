<?php

declare(strict_types=1);

use UI\Http\Handler\PingHandler;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use UI\Http\Handler\HomePageHandler;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', HomePageHandler::class, 'home');
    $app->get('/ping', PingHandler::class, 'api.ping');
};
