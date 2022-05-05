<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 17:33
 */

namespace whereof\easyIm\RongCloud;

use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 *
 * @author qmister
 *
 * @property Request\RongCloudClient request
 * @property User\Client user
 */
class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        RongCloudProvider::class,
    ];
}
