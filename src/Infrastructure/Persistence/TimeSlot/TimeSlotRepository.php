<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\TimeSlot;

use Domain\TimeSlot\TimeSlotCollection;
use Domain\TimeSlot\TimeSlotRepositoryInterface;
use Infrastructure\Hydrator\TimeSlotHydrator;
use Infrastructure\Service\DatabaseService;
use PDO;
use Ramsey\Uuid\UuidInterface;

final class TimeSlotRepository implements TimeSlotRepositoryInterface
{
    public function __construct(
        private DatabaseService $dbService,
        private TimeSlotHydrator $timeSlotHydrator,
    ) {
    }

    public function findByDoctorId(
        UuidInterface $doctorId
    ): TimeSlotCollection {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM timeslots WHERE doctor_id = :doctor_id');

        $stmt->execute([
            'doctor_id' => $doctorId->toString()
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->timeSlotHydrator->hydrateCollection($rows);
    }
}
