<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Domain\Appointment\Service\GetAppointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Exception\AppointmentNotFoundException;
use Ramsey\Uuid\Uuid;

final class GetAppointmentNotFoundTest extends TestCase
{
    public function testThrowsExceptionIfAppointmentNotFound(): void
    {
        $appointmentId = Uuid::uuid4();

        $repo = $this->createMock(AppointmentRepositoryInterface::class);
        $repo->method('findById')->with($appointmentId)->willReturn(null);

        $service = new GetAppointment($repo);

        $this->expectException(AppointmentNotFoundException::class);
        $this->expectExceptionMessage('Appointment with id ' . $appointmentId->toString() . ' not found.');

        $service->get($appointmentId);
    }
}
