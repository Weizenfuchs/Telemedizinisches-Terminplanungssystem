<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\TimeSlot;

use DateTimeImmutable;
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

    public function findByDoctorIdAndDateRange(
        UuidInterface $doctorId,
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate
    ): TimeSlotCollection {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->prepare(
            'SELECT * FROM timeslots 
            WHERE doctor_id = :doctor_id 
            AND start_time >= :start 
            AND end_time <= :end 
            ORDER BY start_time ASC'
        );

        $stmt->execute([
            'doctor_id' => $doctorId->toString(),
            'start' => $startDate->format('Y-m-d H:i:s'),
            'end' => $endDate->format('Y-m-d H:i:s'),
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->timeSlotHydrator->hydrateCollection($rows);
    }
}
