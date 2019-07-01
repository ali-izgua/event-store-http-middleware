<?php

/**
 * This file is part of prooph/event-store-http-middleware.
 * (c) 2018-2019 Alexander Miertsch <kontakt@codeliner.ws>
 * (c) 2018-2019 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStore\Http\Middleware\Container\Action;

use Prooph\EventStore\Http\Middleware\Action\ResetProjection;
use Prooph\EventStore\Projection\ProjectionManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

final class ResetProjectionFactory
{
    public function __invoke(ContainerInterface $container): ResetProjection
    {
        return new ResetProjection($container->get(ProjectionManager::class), $container->get(ResponseFactoryInterface::class));
    }
}
