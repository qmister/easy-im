<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 17:18
 */

namespace whereof\easyIm\Huanxin;

use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 *
 * @author qmister
 *
 * @property Request\HuanxinClient request
 * @property User\UserClinet user
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
