<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Domain\Appointment\Service\DeleteAppointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Appointment;
use Ramsey\Uuid\Uuid;

final class DeleteAppointmentTest extends TestCase
{
    public function testDeletesAppointmentSuccessfully(): void
    {
        $appointment = new Appointment(
            Uuid::uuid4(),
            Uuid::uuid4(),
            'Morpheus',
            'morpheus@zion.org',
            new DateTimeImmutable('2025-05-24 10:00:00'),
            new DateTimeImmutable('2025-05-24 11:00:00'),
            'booked'
        );

        $repo = $this->createMock(AppointmentRepositoryInterface::class);

        $repo->expects($this->once())
            ->method('findById')
            ->with($appointment->getId())
            ->willReturn($appointment);

        $repo->expects($this->once())
            ->method('delete')
            ->with($this->isInstanceOf(Appointment::class));

        $service = new DeleteAppointment($repo);

        $service->delete(Uuid::fromString($appointment->getId()->toString()));
        
        $this->addToAssertionCount(1);
    }
}
