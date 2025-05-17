<?php

declare(strict_types=1);

namespace Domain\Doctor;

use Ramsey\Uuid\UuidInterface;

final class Doctor
{
    private UuidInterface $id;
    private string $name;
    private Specialization $specialization;

    public function __construct(UuidInterface $id, string $name, Specialization $specialization)
    {
        $this->id = $id;
        $this->name = $name;
        $this->specialization = $specialization;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpecialization(): Specialization
    {
        return $this->specialization;
    }
}
