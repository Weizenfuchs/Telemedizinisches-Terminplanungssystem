<?php

return
[
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds'
    ],
    'environments' => [
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'pgsql',
            'host' => 'telemedizin-db-container',
            'name' => 'telemedizin',
            'user' => 'fuchs',
            'pass' => 'schwarzwald',
            'port' => '5432',
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];
