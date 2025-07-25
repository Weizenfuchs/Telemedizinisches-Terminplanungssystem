<?php

declare(strict_types=1);

namespace Mezzio\Exception;

use Psr\Container\ContainerExceptionInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use RuntimeException;

use function get_debug_type;
use function sprintf;

/** @final */
class InvalidMiddlewareException extends RuntimeException implements
    ContainerExceptionInterface,
    ExceptionInterface
{
    /**
     * @param mixed $middleware The middleware that does not fulfill the
     *     expectations of MiddlewarePipe::pipe
     */
    public static function forMiddleware(mixed $middleware): self
    {
        return new self(sprintf(
            'Middleware "%s" is neither a string service name, a PHP callable,'
            . ' a %s instance, a %s instance, or an array of such arguments',
            get_debug_type($middleware),
            MiddlewareInterface::class,
            RequestHandlerInterface::class
        ));
    }

    /**
     * @param mixed $service The actual service created by the container.
     */
    public static function forMiddlewareService(string $name, mixed $service): self
    {
        return new self(sprintf(
            'Service "%s" did not to resolve to a %s instance; resolved to "%s"',
            $name,
            MiddlewareInterface::class,
            get_debug_type($service)
        ));
    }
}
