<?php

declare(strict_types=1);

namespace Domain\TimeSlot;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class TimeSlot
{
    public function __construct(
        private readonly UuidInterface $id,
        private readonly UuidInterface $doctorId,
        private readonly string $startTime,
        private readonly string $endTime,
        private readonly string $weekday,
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

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function getWeekday(): string
    {
        return $this->weekday;
    }
}
