<?php

declare(strict_types=1);

namespace Domain\Doctor;

use Ramsey\Uuid\UuidInterface;

interface DoctorRepositoryInterface
{
    public function findById(UuidInterface $id): ?Doctor;

    public function findAll(): DoctorCollection;

    public function save(Doctor $doctor): void;

    public function delete(UuidInterface $id): void;
}
