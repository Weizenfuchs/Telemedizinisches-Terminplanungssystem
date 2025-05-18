<?php

declare(strict_types=1);

namespace Infrastructure\Hydrator;

use Domain\Appointment\Appointment;
use Domain\Appointment\AppointmentCollection;
use Ramsey\Uuid\Uuid;

final class AppointmentHydrator
{
    public function hydrate(array $row): Appointment
    {
        return new Appointment(
            Uuid::fromString($row['id']),
            Uuid::fromString($row['doctor_id']),
            $row['patient_name'],
            $row['patient_email'],
            new \DateTimeImmutable($row['start_time']),
            new \DateTimeImmutable($row['end_time']),
            $row['status']
        );
    }

    public function hydrateCollection(array $rows): AppointmentCollection
    {
        $collection = new AppointmentCollection();

        foreach ($rows as $row) {
            $collection->add($this->hydrate($row));
        }

        return $collection;
    }
}
