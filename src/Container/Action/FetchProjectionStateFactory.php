<?php

/**
 * This file is part of prooph/event-store-http-middleware.
 * (c) 2018-2018 prooph software GmbH <contact@prooph.de>
 * (c) 2018-2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStore\Http\Middleware\Container\Action;

use Psr\Http\Message\ResponseFactoryInterface;
use Prooph\EventStore\Http\Middleware\Action\FetchProjectionState;
use Prooph\EventStore\Http\Middleware\JsonTransformer;
use Prooph\EventStore\Projection\ProjectionManager;
use Psr\Container\ContainerInterface;

final class FetchProjectionStateFactory
{
    public function __invoke(ContainerInterface $container): FetchProjectionState
    {
        $actionHandler = new FetchProjectionState($container->get(ProjectionManager::class), $container->get(ResponseFactoryInterface::class));

        $actionHandler->addTransformer(
            $container->get(JsonTransformer::class),
            'application/atom+json',
            'application/json'
        );

        return $actionHandler;
    }
}
