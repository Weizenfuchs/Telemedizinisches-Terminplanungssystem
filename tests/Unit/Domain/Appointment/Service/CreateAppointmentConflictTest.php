<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Domain\Appointment\Service\CreateAppointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Appointment;
use Domain\Appointment\AppointmentCollection;
use Domain\Appointment\Exception\AppointmentConflictException;
use Ramsey\Uuid\Uuid;

final class CreateAppointmentConflictTest extends TestCase
{
    public function testThrowsExceptionIfAppointmentOverlaps(): void
    {
        $doctorId = Uuid::uuid4();

        $existingAppointment = new Appointment(
            Uuid::uuid4(),
            $doctorId,
            'Alice',
            'alice@wonderland.com',
            new DateTimeImmutable('2025-05-23 13:30:00'),
            new DateTimeImmutable('2025-05-23 14:30:00'),
            'booked'
        );

        $collection = new AppointmentCollection();
        $collection->add($existingAppointment);

        $repo = $this->createMock(AppointmentRepositoryInterface::class);
        $repo->method('findByDoctorIdAndDateRange')->willReturn($collection);

        $service = new CreateAppointment($repo);

        $this->expectException(AppointmentConflictException::class);
        $this->expectExceptionMessage('Appointment overlaps with an existing one');

        $service->create(
            $doctorId,
            'Neo',
            'neo@matrix.com',
            '2025-05-23 13:00:00',
            '2025-05-23 14:00:00'
        );
    }
}
