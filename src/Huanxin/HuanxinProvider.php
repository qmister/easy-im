<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 17:18
 */

namespace whereof\easyIm\Huanxin;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use whereof\easyIm\Huanxin\Request\HuanxinClient;
use whereof\easyIm\Huanxin\User\UserClinet;

class HuanxinProvider implements ServiceProviderInterface
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
            return new HuanxinClient($app);
        };
        $app['user'] = function ($app) {
            return new UserClinet($app);
        };
    }
}
