<?php

declare(strict_types=1);

namespace Infrastructure\Hydrator;

use Domain\Doctor\Doctor;
use Domain\Doctor\DoctorCollection;
use Ramsey\Uuid\Uuid;

final class DoctorHydrator
{
    public function __construct(private SpecializationHydrator $specializationHydrator) {
    }
    
    public function hydrate(array $row): Doctor
    {
        $specializationData = [
            'id' => $row['specialization_id'],
            'name' => $row['specialization_name'],
        ];
        $specialization = $this->specializationHydrator->hydrate($specializationData);

        return new Doctor(
            Uuid::fromString($row['id']),
            $row['name'],
            $specialization
        );
    }

    public function hydrateCollection(array $rows): DoctorCollection
    {
        $doctorCollection = new DoctorCollection();

        foreach ($rows as $row) {
            $specializationData = [
                'id' => $row['specialization_id'],
                'name' => $row['specialization_name'],
            ];
            $specialization = $this->specializationHydrator->hydrate($specializationData);

            $doctorCollection->add(
                new Doctor(
                    Uuid::fromString($row['id']),
                    $row['name'],
                    $specialization
                )
            );
        }

        return $doctorCollection;
    }
}
