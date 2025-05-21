<?php

declare(strict_types=1);

namespace Domain\Appointment\Service;

use Domain\Appointment\Appointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use DateTimeImmutable;
use Domain\Appointment\Exception\AppointmentConflictException;
use Domain\Appointment\Exception\InvalidAppointmentTimeException;

final class CreateAppointment
{
    public function __construct(
        private AppointmentRepositoryInterface $appointmentRepository
    ) {}

    /**
     * @throws AppointmentConflictException
     * @throws InvalidAppointmentTimeException
     */
    public function create(
        UuidInterface $doctorId,
        string $patientName,
        string $patientEmail,
        string $startTime,
        string $endTime
    ): Appointment {
        try {
            $start = new DateTimeImmutable($startTime);
            $end = new DateTimeImmutable($endTime);
        } catch (\Exception $e) {
            throw new InvalidAppointmentTimeException('Invalid date format');
        }

        if ($start >= $end) {
            throw new InvalidAppointmentTimeException('Start time must be before end time');
        }

        $appointments = $this->appointmentRepository->findByDoctorIdAndDateRange($doctorId, $start, $end);

        foreach ($appointments as $existing) {
            if ($start < $existing->getEndTime() && $end > $existing->getStartTime()) {
                throw new AppointmentConflictException('Appointment overlaps with an existing one');
            }
        }

        $appointment = new Appointment(
            Uuid::uuid4(),
            $doctorId,
            $patientName,
            $patientEmail,
            $start,
            $end,
            'booked'
        );

        $this->appointmentRepository->save($appointment);

        return $appointment;
    }
}
