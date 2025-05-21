<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Appointment\Exception\AppointmentNotFoundException;
use Domain\Appointment\Service\GetAppointment;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

final class GetAppointmentHandler implements RequestHandlerInterface
{
    public function __construct(
        private GetAppointment $getAppointment,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        if (empty($id)) {
            return new JsonResponse(['error' => 'Missing appointment id'], 400);
        }

        try {
            $appointment = $this->getAppointment->get(
                Uuid::fromString($id)
            );
        } catch (AppointmentNotFoundException $e) {
            return new JsonResponse(['error' => 'Appointment not found'], 404);
        }
         catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => 'Invalid appointment id'], 400);
        }

        return new JsonResponse([
            'id' => $appointment->getId()->toString(),
            'doctor_id' => $appointment->getDoctorId()->toString(),
            'patient_name' => $appointment->getPatientName(),
            'patient_email' => $appointment->getPatientEmail(),
            'start_time' => $appointment->getStartTime()->format('Y-m-d H:i:s'),
            'end_time' => $appointment->getEndTime()->format('Y-m-d H:i:s'),
            'status' => $appointment->getStatus(),
        ]);
    }
}
