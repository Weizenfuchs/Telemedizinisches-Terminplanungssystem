<?php

declare(strict_types=1);

namespace Infrastructure\Service;

use Infrastructure\Service\DatabaseService;
use Psr\Container\ContainerInterface;

class DatabaseServiceFactory
{
    public function __invoke(ContainerInterface $container): DatabaseService
    {
        $config = $container->get('config')['db'] ?? [];

        return new DatabaseService(
            $config['host'] ?? 'telemedizin-db-service',
            $config['name'] ?? 'telemedizin',
            $config['user'] ?? 'fuchs',
            $config['pass'] ?? 'schwarzwald',
            $config['port'] ?? 5432
        );
    }
}
