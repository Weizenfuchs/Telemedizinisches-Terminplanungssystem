<?php

declare(strict_types=1);

namespace Infrastructure\Hydrator;

use Domain\Doctor\Specialization;
use Ramsey\Uuid\Uuid;

final class SpecializationHydrator
{
    public function hydrate(array $data): Specialization
    {
        return new Specialization(
            Uuid::fromString($data['id']),
            $data['name']
        );
    }
}
