<?php

declare(strict_types=1);

namespace Domain\Availability\Service;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Availability\Availability;
use Domain\Availability\AvailabilityCollection;
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
        $now = new DateTimeImmutable('now');
        $endDate = $now->add(new DateInterval('P7D'));

        $timeSlots = $this->timeSlotRepository->findByDoctorId($doctorId);
        $appointments = $this->appointmentRepository->findByDoctorIdAndDateRange($doctorId, $now, $endDate);

        $availabilities = new AvailabilityCollection();

        foreach ($timeSlots as $timeSlot) {
            $timeSlotStartTime = $timeSlot->getStartTime();
            $timeSlotEndTime = $timeSlot->getEndTime();

            $timeSlotStartDate = (new DateTimeImmutable('today'))->format('Y-m-d');
            $timeSlotStart = new DateTimeImmutable("$timeSlotStartDate $timeSlotStartTime");

            $timeSlotEndDate = (new DateTimeImmutable('today'))->format('Y-m-d');
            $timeSlotEnd = new DateTimeImmutable("$timeSlotEndDate $timeSlotEndTime");

            $timeSlotWeekDay = $timeSlot->getWeekday();

            foreach ($appointments as $appointment) {
                $appointmentStart = $appointment->getStartTime();
                $appointmentStartTime = $appointment->getStartTime()->format('H:i:s');
                $appointmentEnd = $appointment->getEndTime();
                $appointmentEndTime = $appointment->getEndTime()->format('H:i:s');
                $appointmentWeekday = $appointmentStart->format('l');
              
                echo('<pre>');
                var_dump($timeSlotWeekDay);
                var_dump($appointmentWeekday);
                echo('appointmentStartTime ');
                var_dump($appointmentStartTime);
                echo('timeSlotStartTime ');
                var_dump($timeSlotStartTime);
                echo('appointmentEndTime ');
                var_dump($appointmentEndTime);
                echo('timeSlotEndTime ');
                var_dump($timeSlotEndTime);
                echo('appointmentStart ');
                var_dump($appointmentStartTime > $timeSlotStartTime);
                var_dump($appointmentEndTime < $timeSlotEndTime);
                echo('</pre>');

                if ($timeSlotWeekDay == $appointmentWeekday) {
                    if ($appointmentStartTime > $timeSlotStartTime && $appointmentEndTime < $timeSlotEndTime) {
                        var_dump('################################################################');
                        $availabilities->add(new Availability($timeSlotStart, $appointmentStart));
                        $availabilities->add(new Availability($appointmentEnd, $timeSlotEnd));
                    }
                }
            }
        }

        echo('<pre>');
        var_dump('--------------------------------------------------------');
        var_dump($availabilities);
        echo('</pre>');
        die;

        return $availabilities;
    }
}
