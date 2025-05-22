<?php

declare(strict_types=1);

use Domain\Appointment\AppointmentCollection;
use PHPUnit\Framework\TestCase;
use Domain\Appointment\Service\CreateAppointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Exception\InvalidAppointmentTimeException;
use Ramsey\Uuid\Uuid;

final class CreateAppointmentInvalidTimeTest extends TestCase
{
    public function testThrowsExceptionIfStartTimeIsAfterEndTime(): void
    {
        $doctorId = Uuid::uuid4();

        $repo = $this->createMock(AppointmentRepositoryInterface::class);
        $repo->method('findByDoctorIdAndDateRange')->willReturn(new AppointmentCollection());

        $service = new CreateAppointment($repo);

        $this->expectException(InvalidAppointmentTimeException::class);
        $this->expectExceptionMessage('Start time must be before end time');

        $service->create(
            $doctorId,
            'Trinity',
            'trinity@matrix.com',
            '2025-05-23 15:00:00',
            '2025-05-23 14:00:00'
        );
    }
}
