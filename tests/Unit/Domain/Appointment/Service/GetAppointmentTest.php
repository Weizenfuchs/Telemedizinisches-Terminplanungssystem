<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Domain\Appointment\Service\GetAppointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Appointment;
use Ramsey\Uuid\Uuid;

final class GetAppointmentTest extends TestCase
{
    public function testReturnsAppointmentIfFound(): void
    {
        $appointmentId = Uuid::uuid4();
        $doctorId = Uuid::uuid4();

        $appointment = new Appointment(
            $appointmentId,
            $doctorId,
            'Mouse',
            'mouse@matrix.com',
            new DateTimeImmutable('2025-05-25 09:00:00'),
            new DateTimeImmutable('2025-05-25 10:00:00'),
            'booked'
        );

        $repo = $this->createMock(AppointmentRepositoryInterface::class);
        $repo->method('findById')->with($appointmentId)->willReturn($appointment);

        $service = new GetAppointment($repo);

        $result = $service->get($appointmentId);

        $this->assertSame($appointment, $result);
    }
}
