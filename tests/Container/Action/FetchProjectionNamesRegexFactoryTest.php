<?php
/**
 * This file is part of the prooph/event-store-http-middleware.
 * (c) 2018-2018 prooph software GmbH <contact@prooph.de>
 * (c) 2018-2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ProophTest\EventStore\Http\Middleware\Container\Action;

use PHPUnit\Framework\TestCase;
use Prooph\EventStore\Http\Middleware\Action\FetchProjectionNamesRegex;
use Prooph\EventStore\Http\Middleware\Container\Action\FetchProjectionNamesRegexFactory;
use Prooph\EventStore\Http\Middleware\ResponsePrototype;
use Prooph\EventStore\Http\Middleware\Transformer;
use Prooph\EventStore\Projection\ProjectionManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class FetchProjectionNamesRegexFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_action_handler(): void
    {
        $projectionManager = $this->prophesize(ProjectionManager::class);
        $responsePrototype = $this->prophesize(ResponseInterface::class);
        $transformer = $this->prophesize(Transformer::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get(ProjectionManager::class)->willReturn($projectionManager->reveal())->shouldBeCalled();
        $container->get(ResponsePrototype::class)->willReturn($responsePrototype->reveal())->shouldBeCalled();
        $container->get(Transformer::class)->willReturn($transformer->reveal())->shouldBeCalled();

        $factory = new FetchProjectionNamesRegexFactory();

        $actionHandler = $factory($container->reveal());

        $this->assertInstanceOf(FetchProjectionNamesRegex::class, $actionHandler);
    }
}
