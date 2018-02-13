<?php

namespace ExpressiveDiscovery;

use Zend\Diactoros\Response\JsonResponse;

class DiscoverAction
{
    /** @var array */
    private $routes;

    /**
     * DiscoverAction constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function __invoke()
    {
        $routes = [];
        foreach ($this->routes as $route) {
            $routes[] = [
                'path' => $route['path'],
                'allowed_methods' => isset($route['allowed_methods']) ? implode(',', $route['allowed_methods']) : [],
            ];
        }
        return new JsonResponse($routes, 200, [], JsonResponse::DEFAULT_JSON_FLAGS | JSON_PRETTY_PRINT);
    }
}
