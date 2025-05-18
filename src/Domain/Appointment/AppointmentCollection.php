<?php

declare(strict_types=1);

namespace Domain\Appointment;

use ArrayIterator;
use IteratorAggregate;

/**
 * @implements IteratorAggregate<int, Appointment>
 */
final class AppointmentCollection implements IteratorAggregate
{
    /** @var Appointment[] */
    private array $appointments = [];

    public function add(Appointment $appointment): void
    {
        $this->appointments[$appointment->getId()->toString()] = $appointment;
    }

    /**
     * @return Appointment[]
     */
    public function all(): array
    {
        return $this->appointments;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->appointments);
    }
}
