<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\Doctor;
use Domain\Doctor\DoctorCollection;
use Domain\Doctor\DoctorRepositoryInterface;
use Domain\Doctor\Specialization;
use Infrastructure\Hydrator\DoctorHydrator;
use Infrastructure\Service\DatabaseService;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use PDO;

final class DoctorRepository implements DoctorRepositoryInterface
{
    private DatabaseService $dbService;
    private DoctorHydrator $doctorHydrator;

    public function __construct(DatabaseService $dbService, DoctorHydrator $doctorHydrator)
    {
        $this->dbService = $dbService;
        $this->doctorHydrator = $doctorHydrator;
    }

    public function findById(UuidInterface $id): ?Doctor
    {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM doctors WHERE id = :id');
        $stmt->execute(['id' => $id->toString()]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->doctorHydrator->hydrate($row);
    }

    public function findAll(): DoctorCollection
    {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->query('SELECT * FROM doctors');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->doctorHydrator->hydrateCollection($rows);
    }

    public function save(Doctor $doctor): void
    {
    }

    public function delete(UuidInterface $id): void
    {
    }
}
