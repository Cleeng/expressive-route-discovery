<?php

namespace ExpressiveDiscovery;

use Psr\Container\ContainerInterface;

class DiscoverHandlerFactory
{
    public function __invoke(ContainerInterface $services): DiscoverHandler
    {
        return new DiscoverHandler($services->get('config')['routes']);
    }
}
