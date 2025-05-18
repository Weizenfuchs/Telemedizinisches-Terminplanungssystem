<?php

declare(strict_types=1);

namespace Infrastructure\Hydrator;

use DateTimeImmutable;
use Domain\TimeSlot\TimeSlot;
use Domain\TimeSlot\TimeSlotCollection;
use Ramsey\Uuid\Uuid;

final class TimeSlotHydrator
{
    public function hydrate(array $row): TimeSlot
    {
        return new TimeSlot(
            Uuid::fromString($row['id']),
            Uuid::fromString($row['doctor_id']),
            new DateTimeImmutable($row['start_time']),
            new DateTimeImmutable($row['end_time']),
        );
    }

    public function hydrateCollection(array $rows): TimeSlotCollection
    {
        $slots = array_map(fn(array $row) => $this->hydrate($row), $rows);

        return new TimeSlotCollection(...$slots);
    }
}
