<?php


namespace whereof\easyIm\Huanxin;


use whereof\easyIm\Kernel\ServiceContainer;


class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        HuanxinProvider::class,
    ];
}
