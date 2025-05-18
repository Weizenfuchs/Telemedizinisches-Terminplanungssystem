<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\Specialization;
use Domain\Doctor\SpecializationRepositoryInterface;
use Infrastructure\Hydrator\SpecializationHydrator;
use Infrastructure\Service\DatabaseService;
use PDO;
use Ramsey\Uuid\UuidInterface;

final class SpecializationRepository implements SpecializationRepositoryInterface
{
    public function __construct(
        private readonly DatabaseService $dbService, 
        private SpecializationHydrator $specializationHydrator
    ) {
    }

    public function findById(UuidInterface $id): ?Specialization
    {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM specializations WHERE id = :id');
        $stmt->execute(['id' => $id->toString()]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->specializationHydrator->hydrate($row);
    }
}
