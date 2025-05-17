<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctor;

use Domain\Doctor\Doctor;
use Domain\Doctor\DoctorCollection;
use Domain\Doctor\DoctorRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final class DoctorRepository implements DoctorRepositoryInterface
{
    private DoctorCollection $doctors;

    public function __construct()
    {
        $this->doctors = new DoctorCollection();
    }

    public function findById(UuidInterface $id): ?Doctor
    {
        return $this->doctors->get($id);
    }

    public function findAll(): array
    {
        return $this->doctors->all();
    }

    public function save(Doctor $doctor): void
    {
        $this->doctors->add($doctor);
    }

    public function delete(UuidInterface $id): void
    {
        $this->doctors->remove($id);
    }
}
