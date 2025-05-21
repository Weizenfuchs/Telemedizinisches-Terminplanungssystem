<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Appointment;

use DateTimeImmutable;
use Domain\Appointment\Appointment;
use Domain\Appointment\AppointmentCollection;
use Domain\Appointment\AppointmentRepositoryInterface;
use Infrastructure\Hydrator\AppointmentHydrator;
use Infrastructure\Service\DatabaseService;
use PDO;
use Ramsey\Uuid\UuidInterface;

final class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function __construct(
        private DatabaseService $dbService,
        private AppointmentHydrator $appointmentHydrator,
    ) {
    }

    public function findByDoctorIdAndDateRange(
        UuidInterface $doctorId,
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate
    ): AppointmentCollection {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->prepare(
            'SELECT * FROM appointments 
            WHERE doctor_id = :doctor_id 
            AND start_time >= :start 
            AND end_time <= :end 
            AND status = :booked
            ORDER BY start_time ASC'
        );

        $stmt->execute([
            'doctor_id' => $doctorId->toString(),
            'start' => $startDate->format('Y-m-d H:i:s'),
            'end' => $endDate->format('Y-m-d H:i:s'),
            'booked' => 'booked'
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->appointmentHydrator->hydrateCollection($rows);
    }

    public function save(Appointment $appointment): void
    {
        $pdo = $this->dbService->getConnection();
        $stmt = $pdo->prepare('
            INSERT INTO appointments (id, doctor_id, patient_name, patient_email, start_time, end_time, status)
            VALUES (:id, :doctor_id, :name, :email, :start, :end, :status)
        ');

        $stmt->execute([
            'id' => $appointment->getId()->toString(),
            'doctor_id' => $appointment->getDoctorId()->toString(),
            'name' => $appointment->getPatientName(),
            'email' => $appointment->getPatientEmail(),
            'start' => $appointment->getStartTime()->format('Y-m-d H:i:s'),
            'end' => $appointment->getEndTime()->format('Y-m-d H:i:s'),
            'status' => $appointment->getStatus(),
        ]);
    }
}
