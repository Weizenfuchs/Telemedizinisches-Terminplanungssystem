<?php

declare(strict_types=1);

namespace Domain\TimeSlot;

use Ramsey\Uuid\UuidInterface;

interface TimeSlotRepositoryInterface
{
    public function findByDoctorId(UuidInterface $id): TimeSlotCollection;
}
