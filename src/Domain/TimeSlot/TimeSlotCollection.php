<?php

declare(strict_types=1);

namespace Domain\TimeSlot;

use Ramsey\Uuid\UuidInterface;
use IteratorAggregate;
use ArrayIterator;

final class TimeSlotCollection implements IteratorAggregate
{
    /** @var TimeSlot[] */
    private array $timeSlot = [];

    public function add(TimeSlot $timeSlot): void
    {
        $this->timeSlot[$timeSlot->id()->toString()] = $timeSlot;
    }

    public function remove(UuidInterface $id): void
    {
        unset($this->timeSlot[$id->toString()]);
    }

    public function get(UuidInterface $id): ?TimeSlot
    {
        return $this->timeSlot[$id->toString()] ?? null;
    }

    /**
     * @return TimeSlot[]
     */
    public function all(): array
    {
        return array_values($this->timeSlot);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->all());
    }
}
