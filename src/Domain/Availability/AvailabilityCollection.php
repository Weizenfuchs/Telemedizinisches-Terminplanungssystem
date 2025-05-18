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

    /**
     * @return Availability[]
     */
    public function all(): array
    {
        return array_values($this->availabilities);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->all());
    }
}
