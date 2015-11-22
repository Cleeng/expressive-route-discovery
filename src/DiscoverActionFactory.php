<?php

namespace ExpressiveDiscovery;

use ExpressiveDiscovery\Action\DiscoverAction;
use Interop\Container\ContainerInterface;

class DiscoverActionFactory
{
    public function __invoke(ContainerInterface $services)
    {
        return new DiscoverAction($services->get('config')['routes']);
    }
}
