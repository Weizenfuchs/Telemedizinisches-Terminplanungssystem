<?php

declare(strict_types=1);

namespace Domain\TimeSlot;

use DateTimeImmutable;
use Ramsey\Uuid\Rfc4122\UuidInterface;

interface TimeSlotRepositoryInterface
{
    public function findByDoctorIdAndDateRange(UuidInterface $id, DateTimeImmutable $startDate, DateTimeImmutable $endDate): TimeSlotCollection;
}
