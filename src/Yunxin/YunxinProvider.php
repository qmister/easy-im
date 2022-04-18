<?php

namespace qmister\easyIm\Yunxin;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use qmister\easyIm\Yunxin\Request\YunxinClient;

class YunxinProvider implements ServiceProviderInterface
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
            return new YunxinClient($app);
        };
    }
}
