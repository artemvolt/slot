<?php

namespace Slotegrator\App\Components;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\TaggedContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as VendorControllerResolver;

/**
 * class ControllerResolver
 */
class ControllerResolver extends VendorControllerResolver
{
    private TaggedContainerInterface $container;

    public function __construct(LoggerInterface $logger = null, TaggedContainerInterface $container)
    {
        parent::__construct($logger);
        $this->container = $container;
    }

    /**
     * Returns an instantiated controller.
     */
    protected function instantiateController(string $class): object
    {
        $class = 'controller_' . str_replace('\\', '_', $class);
        if ($this->container->has($class)) {
            return $this->container->get($class);
        }
        return new $class();
    }
}