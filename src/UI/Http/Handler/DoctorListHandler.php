<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Domain\Doctor\DoctorRepositoryInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class DoctorListHandler implements RequestHandlerInterface
{
    public function __construct(private readonly DoctorRepositoryInterface $repository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $doctors = $this->repository->findAll();

        $data = array_map(function ($doctor) {
            return [
                'id' => $doctor->getId()->toString(),
                'name' => $doctor->getName(),
                'specialization' => [
                    'id' => $doctor->getSpecialization()->getId()->toString(),
                    'name' => $doctor->getSpecialization()->getName(),
                ],
            ];
        }, $doctors);

        return new JsonResponse($data);
    }
}
