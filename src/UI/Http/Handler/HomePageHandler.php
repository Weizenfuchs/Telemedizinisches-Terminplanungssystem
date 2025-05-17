<?php

declare(strict_types=1);

namespace UI\Http\Handler;

use Chubbyphp\Container\MinimalContainer;
use DI\Container as PHPDIContainer;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\ServiceManager\ServiceManager;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router\FastRouteRouter;
use Mezzio\Router\LaminasRouter;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Twig\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly string $containerName,
        private readonly RouterInterface $router,
        private readonly ?TemplateRendererInterface $template = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $endpoints = [
            ['path' => '/ping', 'method' => 'GET', 'description' => 'Health Check der API'],
            ['path' => '/doctors', 'method' => 'GET', 'description' => 'Liste aller Ärzte'],
            ['path' => '/doctors/{id}/timeslots', 'method' => 'GET', 'description' => 'Verfügbare Zeitfenster eines Arztes'],
            ['path' => '/appointments', 'method' => 'POST', 'description' => 'Termin buchen'],
            ['path' => '/appointments/{id}', 'method' => 'GET', 'description' => 'Termin abrufen'],
            ['path' => '/appointments/{id}', 'method' => 'DELETE', 'description' => 'Termin stornieren'],
        ];

        return new JsonResponse([
            'welcome' => 'Telemedizinisches Terminplanungssystem API Version 1.0',
            'available_endpoints' => $endpoints,
        ]);
    }
}
