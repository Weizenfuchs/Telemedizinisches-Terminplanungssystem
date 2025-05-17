<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\Doctor;
use Domain\Doctor\DoctorCollection;
use Domain\Doctor\DoctorRepositoryInterface;
use Domain\Doctor\Specialization;
use Infrastructure\Service\DatabaseService;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use PDO;

final class DoctorRepository implements DoctorRepositoryInterface
{
    private DatabaseService $dbService;

    public function __construct(DatabaseService $dbService)
    {
        $this->dbService = $dbService;
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

        return new Doctor(
            Uuid::fromString($row['id']),
            $row['name'],
            // FUCHS:TODO: Use "find" Method from SpecializationRepository
            new Specialization(Uuid::fromString($row['specialization_id']), 'TEST (TODO)')
        );
    }

    public function findAll(): DoctorCollection
    {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->query('SELECT * FROM doctors');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $doctorCollection = new DoctorCollection();

        foreach ($rows as $row) {
            $doctor = new Doctor(
                Uuid::fromString($row['id']),
                $row['name'],
                // FUCHS:TODO: Replace placeholder when SpecializationRepository is implemented
                new Specialization(Uuid::fromString($row['specialization_id']), 'TEST 2 (TODO)')
            );

            $doctorCollection->add($doctor);
        }
        return $doctorCollection;
    }

    public function save(Doctor $doctor): void
    {
    }

    public function delete(UuidInterface $id): void
    {
    }
}
