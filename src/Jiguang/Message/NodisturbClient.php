<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-24 12:42
 */

namespace whereof\easyIm\Jiguang\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Support\Arr;

/**
 * 免打扰
 * Class NodisturbClient.
 *
 * @author qmister
 */
class NodisturbClient extends JiguangClient
{
    /**
     * global 全局免打扰，0或1 0表示关闭，1表示打开 （可选）.
     *
     * @param $user
     * @param int $global 0或1 0表示关闭，1表示打开 （可选）
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function global($user, $global = 0)
    {
        return $this->set($user, [
            'global' => $global,
        ]);
    }

    /**
     * single 单聊免打扰，支持add remove数组 （可选）.
     *
     * @param $user
     * @param $toUserId
     * @param string $method
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function single($user, $toUserId, $method = 'add')
    {
        $params['single'] = Arr::buildItem($toUserId, $method);

        return $this->set($user, $params);
    }

    /**
     * group 群聊免打扰，支持add remove数组（可选）.
     *
     * @param $user
     * @param $toUserId
     * @param string $method
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function group($user, $toUserId, $method = 'add')
    {
        $params['group'] = Arr::buildItem($toUserId, $method);

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
        return $this->send('post', "v1/users/{$userId}/nodisturb", $params);
    }
}
