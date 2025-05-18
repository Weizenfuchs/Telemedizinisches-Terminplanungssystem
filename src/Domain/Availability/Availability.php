<?php

declare(strict_types=1);

namespace Domain\Availability;

use DateTimeImmutable;

final class Availability
{
    public function __construct(
        private DateTimeImmutable $startTime,
        private DateTimeImmutable $endTime
    ) {}

    public function getStartTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    public function getEndTime(): DateTimeImmutable
    {
        return $this->endTime;
    }

    public function toArray(): array
    {
        return [
            'start_time' => $this->startTime->format('Y-m-d H:i'),
            'end_time'   => $this->endTime->format('Y-m-d H:i'),
        ];
    }
}
