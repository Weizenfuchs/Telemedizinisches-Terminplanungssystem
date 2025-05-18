<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\Doctor;
use Domain\Doctor\DoctorCollection;
use Domain\Doctor\DoctorRepositoryInterface;
use Domain\Doctor\SpecializationRepositoryInterface;
use Infrastructure\Hydrator\DoctorHydrator;
use Infrastructure\Service\DatabaseService;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use PDO;

final class DoctorRepository implements DoctorRepositoryInterface
{
    public function __construct(
        private DatabaseService $dbService,
        private DoctorHydrator $doctorHydrator,
        private SpecializationRepositoryInterface $specializationRepository
    ) {
    }

    public function findById(UuidInterface $id): ?Doctor
    {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->prepare('
            SELECT d.*, s.id AS specialization_id, s.name AS specialization_name
            FROM doctors d
            JOIN specializations s ON d.specialization_id = s.id
            WHERE d.id = :id
        ');
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
        $stmt = $pdo->query('
            SELECT d.*, s.id AS specialization_id, s.name AS specialization_name
            FROM doctors d
            JOIN specializations s ON d.specialization_id = s.id
        ');
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
