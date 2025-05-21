<?php

declare(strict_types=1);

use UI\Http\Handler\CreateAppointmentHandler;
use UI\Http\Handler\DeleteAppointmentHandler;
use UI\Http\Handler\DoctorAvailabilityListHandler;
use UI\Http\Handler\DoctorListHandler;
use UI\Http\Handler\PingHandler;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use UI\Http\Handler\HomePageHandler;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', HomePageHandler::class, 'home');
    $app->get('/ping', PingHandler::class, 'api.ping');
    $app->get('/doctors', DoctorListHandler::class, 'doctor.list');
    $app->get('/doctors/{id}/timeslots', DoctorAvailabilityListHandler::class);
    $app->post('/appointments', CreateAppointmentHandler::class, 'appointment.create');
    $app->delete('/appointments/{id}', DeleteAppointmentHandler::class, 'appointment.delete');
};
