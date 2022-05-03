<?php

namespace whereof\easyIm\RongCloud;

use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 * @property Request\RongCloudClient request
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
