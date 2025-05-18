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
        private readonly DateTimeImmutable $startTime,
        private readonly DateTimeImmutable $endTime,
    ) {
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function doctorId(): UuidInterface
    {
        return $this->doctorId;
    }

    public function startTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    public function endTime(): DateTimeImmutable
    {
        return $this->endTime;
    }
}
