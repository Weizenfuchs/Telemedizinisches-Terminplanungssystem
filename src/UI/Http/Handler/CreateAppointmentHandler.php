<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Appointment\Exception\AppointmentConflictException;
use Domain\Appointment\Exception\InvalidAppointmentTimeException;
use Domain\Appointment\Service\CreateAppointment;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

final class CreateAppointmentHandler implements RequestHandlerInterface
{
    public function __construct(
        private CreateAppointment $createAppointment,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (
            empty($data['doctor_id']) ||
            empty($data['start_time']) ||
            empty($data['end_time']) ||
            empty($data['patient_name']) ||
            empty($data['patient_email'])
        ) {
            return new JsonResponse(['error' => 'Missing required fields'], 400);
        }

        try {
            $appointment = $this->createAppointment->create(
                Uuid::fromString($data['doctor_id']),
                $data['patient_name'],
                $data['patient_email'],
                $data['start_time'],
                $data['end_time']
            );
        } catch (InvalidAppointmentTimeException|AppointmentConflictException $e) {
            return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }

        return new JsonResponse([
            'id' => $appointment->getId()->toString(),
            'doctor_id' => $appointment->getDoctorId()->toString(),
            'patient_name' => $appointment->getPatientName(),
            'patient_email' => $appointment->getPatientEmail(),
            'start_time' => $appointment->getStartTime()->format('Y-m-d H:i:s'),
            'end_time' => $appointment->getEndTime()->format('Y-m-d H:i:s'),
            'status' => $appointment->getStatus(),
        ], 201);
    }
}
