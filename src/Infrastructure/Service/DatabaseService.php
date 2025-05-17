<?php

declare(strict_types=1);

namespace Infrastructure\Service;

use PDO;
use PDOException;

class DatabaseService
{
    private PDO $connection;

    public function __construct(
        string $host,
        string $dbname,
        string $user,
        string $password,
        int $port = 5432
    ) {
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s', $host, $port, $dbname);

        try {
            $this->connection = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            throw new \RuntimeException('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage(), 0, $e);
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
