<?php

declare(strict_types=1);

namespace Infrastructure\Hydrator;

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
            $row['start_time'],
            $row['end_time'],
            $row['weekday'],
        );
    }

    public function hydrateCollection(array $rows): TimeSlotCollection
    {
        $collection = new TimeSlotCollection();

        foreach ($rows as $row) {
            $collection->add($this->hydrate($row));
        }

        return $collection;
    }
}
