<?php

namespace qmister\easyIm\RongCloud;

use qmister\easyIm\Kernel\ServiceContainer;

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
