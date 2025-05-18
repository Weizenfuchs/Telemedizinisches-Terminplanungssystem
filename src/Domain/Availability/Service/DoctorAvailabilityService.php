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
        $now = new DateTimeImmutable('now');
        $endDate = $now->add(new DateInterval('P7D'));

        $timeSlots = $this->timeSlotRepository->findByDoctorIdAndDateRange($doctorId, $now, $endDate);
        $appointments = $this->appointmentRepository->findByDoctorIdAndDateRange($doctorId, $now, $endDate);

        $availability = new AvailabilityCollection();

        for ($date = $now; $date <= $endDate; $date = $date->modify('+1 day')) {
            $weekday = (int) $date->format('N');

            foreach ($timeSlots->getIterator() as $timeSlot) {
                if ($timeSlot->getWeekday() !== $weekday) {
                    continue;
                }

                $slotStart = DateTimeImmutable::createFromFormat(
                    'Y-m-d H:i:s',
                    $date->format('Y-m-d') . ' ' . $timeSlot->getStartTime()->format('H:i:s')
                );
                $slotEnd = DateTimeImmutable::createFromFormat(
                    'Y-m-d H:i:s',
                    $date->format('Y-m-d') . ' ' . $timeSlot->getEndTime()->format('H:i:s')
                );

                $freePeriods = $this->calculateFreePeriods($slotStart, $slotEnd, $appointments);

                foreach ($freePeriods as [$freeStart, $freeEnd]) {
                    $availability->add(new Availability($freeStart, $freeEnd));
                }
            }
        }

        return $availability;
    }


    private function calculateFreePeriods(
        DateTimeImmutable $periodStart,
        DateTimeImmutable $periodEnd,
        iterable $appointments
    ): array {
        $busySlots = [];

        foreach ($appointments as $appointment) {
            $apptStart = $appointment->getStart();
            $apptEnd = $appointment->getEnd();

            if ($apptEnd > $periodStart && $apptStart < $periodEnd) {
                $busySlots[] = [
                    'start' => max($apptStart, $periodStart),
                    'end' => min($apptEnd, $periodEnd),
                ];
            }
        }

        usort($busySlots, fn($a, $b) => $a['start'] <=> $b['start']);

        $freePeriods = [];
        $cursor = $periodStart;

        foreach ($busySlots as $busy) {
            if ($cursor < $busy['start']) {
                $freePeriods[] = [$cursor, $busy['start']];
            }

            if ($busy['end'] > $cursor) {
                $cursor = $busy['end'];
            }
        }

        if ($cursor < $periodEnd) {
            $freePeriods[] = [$cursor, $periodEnd];
        }

        return $freePeriods;
    }
}
