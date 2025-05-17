<?php

declare(strict_types=1);

namespace UI\Http\Extractor;

use Domain\Doctor\Doctor;
use Domain\Doctor\DoctorCollection;

final class DoctorExtractor
{
    public function extract(Doctor $doctor): array
    {
        return [
            'id' => (string) $doctor->getId(),
            'name' => $doctor->getName(),
            'specialization' => [
                'id' => (string) $doctor->getSpecialization()->getId(),
                'name' => $doctor->getSpecialization()->getName(),
            ],
        ];
    }

    public function extractCollection(DoctorCollection $doctors): array
    {
        $result = [];
        foreach ($doctors->all() as $doctor) {
            $result[] = $this->extract($doctor);
        }
        return $result;
    }
}
