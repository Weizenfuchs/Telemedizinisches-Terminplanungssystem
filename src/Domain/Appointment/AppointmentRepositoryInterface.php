<?php

declare(strict_types=1);

namespace Domain\Appointment;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

interface AppointmentRepositoryInterface
{
    public function findByDoctorIdAndDateRange(UuidInterface $id, DateTimeImmutable $startDate, DateTimeImmutable $endDate): AppointmentCollection;

    public function save(Appointment $appointment): void;
}
