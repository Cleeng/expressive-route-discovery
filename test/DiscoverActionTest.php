<?php

namespace CleengTest\ExpressiveDiscovery;

use ExpressiveDiscovery\DiscoverAction;
use PHPUnit_Framework_TestCase;
use Zend\Diactoros\Response\JsonResponse;

class DiscoverActionTest extends PHPUnit_Framework_TestCase
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

        $action = new DiscoverAction($routes);
        $response = $action();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(
            [['path' => '/', 'allowed_methods' => "GET"]],
            json_decode($response->getBody()->__toString(), true)
        );
    }
}
