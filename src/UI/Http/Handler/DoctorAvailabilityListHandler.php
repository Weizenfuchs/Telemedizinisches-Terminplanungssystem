<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Availability\Service\DoctorAvailabilityService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;
use UI\Http\Extractor\AvailabilityExtractor;

final class DoctorAvailabilityListHandler implements RequestHandlerInterface
{
    public function __construct(
        private DoctorAvailabilityService $doctorAvailabilityService,
        private AvailabilityExtractor $availabilityExtractor
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $doctorId = Uuid::fromString($id);

        $availabilities = $this->doctorAvailabilityService->getAvailabilityForDoctor($doctorId);
        $data = $this->availabilityExtractor->extractCollection($availabilities);

        return new JsonResponse($data);
    }
}
