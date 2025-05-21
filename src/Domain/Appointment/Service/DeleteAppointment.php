<?php

declare(strict_types=1);

namespace Domain\Appointment\Service;

use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Exception\AppointmentNotFoundException;
use Ramsey\Uuid\Uuid;

final class DeleteAppointment
{
    public function __construct(
        private AppointmentRepositoryInterface $appointmentRepository
    ) {}

    public function delete(string $appointmentId): void
    {
        $appointment = $this->appointmentRepository->findById(Uuid::fromString($appointmentId));

        if ($appointment === null) {
            throw new AppointmentNotFoundException("Appointment not found");
        }

        $this->appointmentRepository->delete($appointment);
    }
}
