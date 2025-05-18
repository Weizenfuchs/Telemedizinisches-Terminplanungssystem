<?php

declare(strict_types=1);

namespace Domain\Availability\Service;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Availability\Availability;
use Domain\Availability\AvailabilityCollection;
use Domain\TimeSlot\TimeSlot;
use Domain\TimeSlot\TimeSlotRepositoryInterface;
use Ramsey\Uuid\UuidInterface;
use DateTimeImmutable;
use DateInterval;

final class DoctorAvailabilityService
{
    public function __construct(
        private TimeSlotRepositoryInterface $timeSlotRepository,
        private AppointmentRepositoryInterface $appointmentRepository,
    ) {}

    public function getAvailabilityForDoctor(UuidInterface $doctorId): AvailabilityCollection
    {
        $now = new DateTimeImmutable(datetime: 'now');
        $endDate = $now->add(new DateInterval('P7D'));

        $timeSlots = $this->timeSlotRepository->findByDoctorId($doctorId);
        $appointments = $this->appointmentRepository->findByDoctorIdAndDateRange($doctorId, $now, $endDate);

        $availability = new AvailabilityCollection();

        // FUCHS:TODO: Availabilities aufgrund der Timeslots - Appointments festlegen und zurück geben
        foreach ($timeSlots as $timeSlot) {
            echo("<pre>");
            var_dump($timeSlot);
            echo("</pre>");
        }

        foreach ($appointments as $appointment) {
            echo("<pre>");
            var_dump($appointment);
            echo("</pre>");
        }

        die;

        return $availability;
    }
}
