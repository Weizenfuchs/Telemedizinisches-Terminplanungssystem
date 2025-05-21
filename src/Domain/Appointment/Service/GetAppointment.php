<?php

declare(strict_types=1);

namespace Domain\Appointment\Service;

use Domain\Appointment\Appointment;
use Domain\Appointment\Exception\AppointmentNotFoundException;
use Domain\Appointment\AppointmentRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final class GetAppointment
{
    public function __construct(
        private AppointmentRepositoryInterface $appointmentRepository,
    ) {}

    /**
     * @throws AppointmentNotFoundException
     */
    public function get(UuidInterface $id): Appointment
    {
        $appointment = $this->appointmentRepository->findById($id);

        if ($appointment === null) {
            throw new AppointmentNotFoundException("Appointment with id {$id->toString()} not found.");
        }

        return $appointment;
    }
}
