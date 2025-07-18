<?php

declare(strict_types=1);

namespace Mezzio\Container;

use ArrayAccess;
use Psr\Container\ContainerInterface;
use Whoops\Handler\PrettyPageHandler;

use function get_debug_type;
use function is_callable;
use function is_string;
use function sprintf;

/**
 * Create and return an instance of the whoops PrettyPageHandler.
 *
 * Register this factory as the service `Mezzio\WhoopsPageHandler` in
 * the container of your choice.
 *
 * This service has an optional dependency on the "config" service, which should
 * return an array or ArrayAccess instance. If found, it looks for the following
 * structure:
 *
 * <code>
 * 'whoops' => [
 *     'editor' => 'editor name, editor service name, or callable',
 * ]
 * </code>
 *
 * If an editor is provided, it checks to see if it maps to a known service in
 * the container, and will use that; otherwise, it uses the value verbatim.
 *
 * @final
 */
class WhoopsPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): PrettyPageHandler
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['whoops'] ?? [];

        $pageHandler = new PrettyPageHandler();

        $this->injectEditor($pageHandler, $config, $container);

        return $pageHandler;
    }

    /**
     * Inject an editor into the whoops configuration.
     *
     * @see https://github.com/filp/whoops/blob/master/docs/Open%20Files%20In%20An%20Editor.md
     *
     * @param array|ArrayAccess $config
     * @throws Exception\InvalidServiceException For an invalid editor definition.
     */
    private function injectEditor(PrettyPageHandler $handler, $config, ContainerInterface $container): void
    {
        if (! isset($config['editor'])) {
            return;
        }

        $editor = $config['editor'];

        if (is_callable($editor)) {
            $handler->setEditor($editor);
            return;
        }

        if (! is_string($editor)) {
            throw new Exception\InvalidServiceException(sprintf(
                'Whoops editor must be a string editor name, string service name, or callable; received "%s"',
                get_debug_type($editor)
            ));
        }

        if ($container->has($editor)) {
            $editor = $container->get($editor);
        }

        $handler->setEditor($editor);
    }
}
