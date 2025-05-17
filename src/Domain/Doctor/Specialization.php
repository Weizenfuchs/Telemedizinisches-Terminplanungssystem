<?php

declare(strict_types=1);

namespace Domain\Doctor;

use Ramsey\Uuid\UuidInterface;

final class Specialization
{
    private UuidInterface $id;
    private string $name;

    public function __construct(UuidInterface $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
