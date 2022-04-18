<?php

namespace qmister\easyIm\Yunxin;

use qmister\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 *
 * @property Request\YunxinClient request
 */
class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        YunxinProvider::class,
    ];
}
