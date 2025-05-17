<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Doctor\DoctorRepositoryInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UI\Http\Extractor\DoctorExtractor;

final class DoctorListHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly DoctorRepositoryInterface $repository,
        private readonly DoctorExtractor $doctorExtractor
        ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var \Domain\Doctor\DoctorCollection $doctors */
        $doctors = $this->repository->findAll();
        $data = $this->doctorExtractor->extractCollection($doctors);

        return new JsonResponse($data);
    }
}
