<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 23:52
 */

namespace whereof\easyIm\RongCloud\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserInterface;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * Class User.
 *
 * @author qmister
 */
class Client extends RongCloudClient implements UserInterface
{
    /**
     * 注册用户
     * https://docs.rongcloud.cn/v4/views/im/server/user/register.html.
     *
     * @param $userId
     * @param null $name
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function create($userId, $name = null)
    {
        $params = [
            'userId' => $userId,
            'name'   => $name ?? uniqid('easyIm_'),
        ];

        return $this->send('user/getToken.json', $params);
    }

    /**
     * 获取信息
     * https://doc.rongcloud.cn/imserver/server/v1/user/get.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function info($userId)
    {
        $params = [
            'userId' => $userId,
        ];

        return $this->send('user/info.json', $params);
    }

    /**
     * https://doc.rongcloud.cn/imserver/server/v1/user/delete.
     *
     * @param $userId
     */
    public function delete($userId)
    {
        // TODO: Implement delete() method.
    }

    /**
     * 用户状态
     * https://doc.rongcloud.cn/imserver/server/v1/user/onlinestatus.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function status($userId)
    {
        $params = [
            'userId' => $userId,
        ];

        return $this->send('user/checkOnline.json', $params);
    }

    /**
     * Token 失效
     * https://doc.rongcloud.cn/imserver/server/v1/user/expire.
     *
     * @param $userId
     * @param int $expire
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function expire($userId, $expire = 0)
    {
        $params = [
            'userId' => $userId,
            'time'   => time() + $expire,
        ];

        return $this->send('user/token/expire.json', $params);
    }
}
