<?php

namespace CleengTest\ExpressiveDiscovery;

use ExpressiveDiscovery\DiscoverHandler;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

class DiscoverHandlerTest extends TestCase
{
    public function testActionReturnsRouteList()
    {
        $routes = [
            [
                'name' => 'home',
                'path' => '/',
                'allowed_methods' => ['GET'],
            ]
        ];

        $handler = new DiscoverHandler($routes);
        $response = $handler->handle(new ServerRequest());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(
            [['path' => '/', 'allowed_methods' => "GET"]],
            json_decode($response->getBody()->__toString(), true)
        );
    }
}
