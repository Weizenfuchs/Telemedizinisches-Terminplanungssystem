<?php

declare(strict_types=1);

namespace Mezzio\Container;

use Mezzio\MiddlewareContainer;
use Mezzio\MiddlewareFactory;
use Mezzio\MiddlewareFactoryInterface;
use Psr\Container\ContainerInterface;

/** @final */
class MiddlewareFactoryFactory
{
    public function __invoke(ContainerInterface $container): MiddlewareFactoryInterface
    {
        return new MiddlewareFactory(
            $container->get(MiddlewareContainer::class)
        );
    }
}
