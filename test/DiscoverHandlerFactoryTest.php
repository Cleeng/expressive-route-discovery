<?php

declare(strict_types=1);

namespace CleengTest\ExpressiveDiscovery;

use ExpressiveDiscovery\DiscoverHandlerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\ServerRequest;

final class DiscoverHandlerFactoryTest extends TestCase
{
    public function testInjectsConfigurationToAction()
    {
        $factory = new DiscoverHandlerFactory();
        $handler = $factory($this->mockContainer());
        $response = $handler->handle(new ServerRequest());
        $this->assertEquals(
            [['path' => '/', 'allowed_methods' => "GET"]],
            json_decode($response->getBody()->__toString(), true)
        );
    }

    private function mockContainer(): ContainerInterface
    {
        return new class implements ContainerInterface {
            public function get($id)
            {
                if ($id == 'config') {
                    return [
                        'routes' => [
                            [
                                'name' => 'home',
                                'path' => '/',
                                'allowed_methods' => ['GET'],
                            ],
                        ],
                    ];
                }
                return null;
            }

            public function has($id)
            {
                return true;
            }
        };
    }
}
