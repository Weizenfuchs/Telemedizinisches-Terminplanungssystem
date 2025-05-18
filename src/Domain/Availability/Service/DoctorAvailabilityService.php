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
            $slotStartTime = $timeSlot->getStartTime();
            $slotEndTime = $timeSlot->getEndTime();
            $slotWeekDay = $timeSlot->getWeekday();

            // Gehe jeden Tag im Zeitraum durch
            for ($date = $now; $date <= $endDate; $date = $date->add(new DateInterval('P1D'))) {
                // Nur TimeSlots die zum Wochentag passen
                if ($date->format('l') !== $slotWeekDay) {
                    continue;
                }

                $dayStart = new DateTimeImmutable($date->format('Y-m-d') . ' ' . $slotStartTime);
                $dayEnd = new DateTimeImmutable($date->format('Y-m-d') . ' ' . $slotEndTime);
                $freeStart = $dayStart;

                // Finde alle Termine an diesem Tag im TimeSlot
                $appointmentsOnDay = array_filter($appointments->all(), function ($appointment) use ($dayStart, $dayEnd) {
                    return $appointment->getStartTime() < $dayEnd && $appointment->getEndTime() > $dayStart;
                });

                // Sortiere nach Startzeit
                usort($appointmentsOnDay, fn($a, $b) => $a->getStartTime() <=> $b->getStartTime());

                foreach ($appointmentsOnDay as $appointment) {
                    $appointmentStart = $appointment->getStartTime();
                    $appointmentEnd = $appointment->getEndTime();

                    // Wenn zwischen freeStart und dem Termin noch Zeit ist, ist das eine freie Zeit
                    if ($appointmentStart > $freeStart) {
                        $availabilities->add(new Availability($freeStart, $appointmentStart));
                    }

                    // Verschiebe den nächsten freien Anfang
                    if ($appointmentEnd > $freeStart) {
                        $freeStart = $appointmentEnd;
                    }
                }

                // Nach dem letzten Termin bis zum Slot-Ende ist auch noch frei
                if ($freeStart < $dayEnd) {
                    $availabilities->add(new Availability($freeStart, $dayEnd));
                }
            }
        }

        return $availabilities;
    }
}
