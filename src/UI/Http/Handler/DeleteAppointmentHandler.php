<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Appointment\Exception\AppointmentNotFoundException;
use Domain\Appointment\Service\DeleteAppointment;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

final class DeleteAppointmentHandler implements RequestHandlerInterface
{
    public function __construct(
        private DeleteAppointment $deleteAppointment,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        if (empty($id) || !Uuid::isValid($id)) {
            return new JsonResponse(['error' => 'Invalid appointment ID'], 400);
        }

        try {
            $this->deleteAppointment->delete($id);
        } catch (AppointmentNotFoundException $e) {
            return new JsonResponse(['error' => 'Appointment not found'], 404);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getTraceAsString()], 500);
        }

        return new JsonResponse(['message' => 'Appointment deleted'], 200);
    }
}
