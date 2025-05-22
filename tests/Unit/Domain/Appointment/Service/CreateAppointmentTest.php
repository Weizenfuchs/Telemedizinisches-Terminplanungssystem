<?php

declare(strict_types=1);

use Domain\Appointment\AppointmentCollection;
use PHPUnit\Framework\TestCase;
use Domain\Appointment\Service\CreateAppointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Appointment;
use Ramsey\Uuid\Uuid;

final class CreateAppointmentTest extends TestCase
{
    public function testCreatesAppointmentSuccessfully(): void
    {
        $doctorId = Uuid::uuid4();
        $start = '2025-05-23 13:00:00';
        $end = '2025-05-23 14:00:00';
        $startDayTime = new DateTimeImmutable($start);
        $endDayTime = new DateTimeImmutable($end);

        $repo = $this->createMock(AppointmentRepositoryInterface::class);
        $repo->expects($this->once())
            ->method('findByDoctorIdAndDateRange')
            ->with($doctorId, $startDayTime, $endDayTime)
            ->willReturn(new AppointmentCollection());

        $repo->expects($this->once())
            ->method('save')
            ->with($this->callback(function (Appointment $appointment) use ($doctorId, $startDayTime, $endDayTime) {
                return
                    $appointment->getDoctorId()->equals($doctorId) &&
                    $appointment->getStartTime() == $startDayTime &&
                    $appointment->getEndTime() == $endDayTime &&
                    $appointment->getStatus() === 'booked';
            }));

        $service = new CreateAppointment($repo);

        $result = $service->create(
            $doctorId,
            'Tiffany',
            'Tiff@gmail.com',
            $start,
            $end
        );

        $this->assertInstanceOf(Appointment::class, $result);
    }
}
