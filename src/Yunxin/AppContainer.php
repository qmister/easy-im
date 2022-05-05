<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 17:37
 */

namespace whereof\easyIm\Yunxin;

use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 *
 * @author qmister
 *
 * @property Request\YunxinClient request
 * @property User\UserClinet user
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
