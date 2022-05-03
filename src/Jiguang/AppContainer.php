<?php


namespace whereof\easyIm\Jiguang;

use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 * @property Request\JiguangClient request
 */
class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        JiguangProvider::class,
    ];
}
