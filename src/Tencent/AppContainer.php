<?php

namespace whereof\easyIm\Tencent;

use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 * @property Request\TencentClient request
 */
class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        TencentProvider::class,
    ];
}
