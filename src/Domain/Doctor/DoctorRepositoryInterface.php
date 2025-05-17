<?php

declare(strict_types=1);

namespace Domain\Doctor;

use Ramsey\Uuid\UuidInterface;

interface DoctorRepositoryInterface
{
    public function findById(UuidInterface $id): ?Doctor;

    /**
     * @return Doctor[]
     */
    public function findAll(): array;

    public function save(Doctor $doctor): void;

    public function delete(UuidInterface $id): void;
}
