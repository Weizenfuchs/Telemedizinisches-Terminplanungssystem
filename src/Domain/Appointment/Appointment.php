<?php

declare(strict_types=1);

namespace Domain\Appointment;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class Appointment
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $doctorId,
        private string $patientName,
        private string $patientEmail,
        private DateTimeImmutable $startTime,
        private DateTimeImmutable $endTime,
        private string $status
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getDoctorId(): UuidInterface
    {
        return $this->doctorId;
    }

    public function getPatientName(): string
    {
        return $this->patientName;
    }

    public function getPatientEmail(): string
    {
        return $this->patientEmail;
    }

    public function getStartTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    public function getEndTime(): DateTimeImmutable
    {
        return $this->endTime;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isBooked(): bool
    {
        return $this->status === AppointmentStatus::BOOKED;
    }

    public function isCancelled(): bool
    {
        return $this->status === AppointmentStatus::CANCELLED;
    }

    public function isCompleted(): bool
    {
        return $this->status === AppointmentStatus::COMPLETED;
    }
}
