<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-24 12:53
 */

namespace whereof\easyIm\Jiguang\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Support\Arr;

/**
 * Class CrossNodisturbClient.
 *
 * @author qmister
 */
class CrossNodisturbClient extends JiguangClient
{
    /**
     * global 全局免打扰，0或1 0表示关闭，1表示打开 （可选）.
     *
     * @param $user
     * @param string $appKey 目标的appkey
     * @param int    $global 0或1 0表示关闭，1表示打开 （可选）
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function global($user, $appKey, $global = 0)
    {
        $params = [
            'appkey' => $appKey,
            'global' => $global,
        ];

        return $this->set($user, $params);
    }

    /**
     * single 单聊免打扰，支持add remove数组 （可选）.
     *
     * @param $user
     * @param $toUserId
     * @param string $method
     * @param string $appKey 目标的appkey
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function single($user, $toUserId, $appKey, $method = 'add')
    {
        $params = [
            'appkey' => $appKey,
            'single' => Arr::buildItem($toUserId, $method),
        ];

        return $this->set($user, $params);
    }

    /**
     * group 群聊免打扰，支持add remove数组（可选）.
     *
     * @param $user
     * @param $toUserId
     * @param string $appKey 目标的appkey
     * @param string $method
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function group($user, $toUserId, $appKey, $method = 'add')
    {
        $params = [
            'appkey' => $appKey,
            'group'  => Arr::buildItem($toUserId, $method),
        ];

        return $this->set($user, $params);
    }

    /**
     * @param $userId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function set($userId, $params)
    {
        return $this->send('post', "v1/cross/users/{$userId}/nodisturb", $params);
    }
}
