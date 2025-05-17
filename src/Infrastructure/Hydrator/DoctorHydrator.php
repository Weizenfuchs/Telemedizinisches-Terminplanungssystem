<?php

declare(strict_types=1);

namespace Infrastructure\Hydrator;

use Domain\Doctor\Doctor;
use Domain\Doctor\DoctorCollection;
use Domain\Doctor\Specialization;
use Ramsey\Uuid\Uuid;

final class DoctorHydrator
{
    public function hydrate(array $data): Doctor
    {
        return new Doctor(
            Uuid::fromString($data['id']),
            $data['name'],
            new Specialization(
                Uuid::fromString($data['specialization_id']),
                $data['specialization_name'] ?? 'Unbekannt'
            )
        );
    }

    public function hydrateCollection(array $dataCollection): DoctorCollection
    {
        $doctorCollection = new DoctorCollection();

        foreach ($dataCollection as $data) {
            $doctorCollection->add($this->hydrate($data));
            
        }

        return $doctorCollection;
    }
}
