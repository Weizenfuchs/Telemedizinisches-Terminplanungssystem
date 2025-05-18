<?php

declare(strict_types=1);

namespace Domain\Doctor;

use Ramsey\Uuid\UuidInterface;

interface SpecializationRepositoryInterface
{
    public function findById(UuidInterface $id): ?Specialization;
}
