<?php

namespace ExpressiveDiscovery;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class DiscoverHandler implements RequestHandlerInterface
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

    public function handle(ServerRequestInterface $request): ResponseInterface
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
