<?php

namespace whereof\easyIm\Yunxin;

use whereof\easyIm\Kernel\ServiceContainer;


class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        YunxinProvider::class,
    ];
}
