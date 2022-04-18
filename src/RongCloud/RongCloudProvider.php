<?php

namespace qmister\easyIm\RongCloud;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use qmister\easyIm\RongCloud\Request\RongCloudClient;

class RongCloudProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $app
     */
    public function register(Container $app)
    {
        // TODO: Implement register() method.
        $app['request'] = function ($app) {
            return new RongCloudClient($app);
        };
    }
}
