<?php

declare(strict_types=1);

namespace Domain\Availability;

use IteratorAggregate;
use ArrayIterator;

final class AvailabilityCollection implements IteratorAggregate
{
    /** @var Availability[] */
    private array $availabilities = [];

    public function add(Availability $availability): void
    {
        $this->availabilities[] = $availability;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->availabilities);
    }

    public function toArray(): array
    {
        return array_map(
            fn(Availability $a) => $a->toArray(),
            $this->availabilities
        );
    }

    public static function fromArray(array $data): self
    {
        $collection = new self();
        foreach ($data as $item) {
            $collection->add(new Availability(
                new \DateTimeImmutable($item['start_time']),
                new \DateTimeImmutable($item['end_time']),
            ));
        }
        return $collection;
    }
}
