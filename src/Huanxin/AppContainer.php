<?php


namespace qmister\easyIm\Huanxin;

use qmister\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 * @property Request\HuanxinClient request
 */
class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        HuanxinProvider::class,
    ];
}
