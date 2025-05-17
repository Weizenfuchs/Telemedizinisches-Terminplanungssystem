<?php

declare(strict_types=1);

namespace Domain\Doctor;

use Ramsey\Uuid\UuidInterface;
use IteratorAggregate;
use ArrayIterator;

final class DoctorCollection implements IteratorAggregate
{
    /** @var Doctor[] */
    private array $doctors = [];

    public function add(Doctor $doctor): void
    {
        $this->doctors[$doctor->getId()->toString()] = $doctor;
    }

    public function remove(UuidInterface $id): void
    {
        unset($this->doctors[$id->toString()]);
    }

    public function get(UuidInterface $id): ?Doctor
    {
        return $this->doctors[$id->toString()] ?? null;
    }

    /**
     * @return Doctor[]
     */
    public function all(): array
    {
        return array_values($this->doctors);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->all());
    }
}
