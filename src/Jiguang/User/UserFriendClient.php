<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-22 22:53
 */

namespace whereof\easyIm\Jiguang\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Interfaces\UserFriendInterface;

/**
 * Class UserFriendClient.
 *
 * @author qmister
 */
class UserFriendClient extends JiguangClient implements UserFriendInterface
{
    /**
     * 查询关系.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function query($userId)
    {
        return $this->send('get', 'v1/users/'."{$userId}/friends");
    }

    /**
     * 建立关系.
     *
     * @param $userId
     * @param $toUserId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addTo($userId, $toUserId)
    {
        $params = (array) $toUserId;

        return $this->send('post', 'v1/users/'."{$userId}/friends", $params);
    }

    /**
     * 更新好友备注.
     *
     * @param $userId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function updateNotename($userId, $params)
    {
        return $this->send('put', 'v1/users/'."{$userId}/friends", $params);
    }

    /**
     * 移除关系.
     *
     * @param $userId
     * @param $toUserId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function remove($userId, $toUserId)
    {
        $params = (array) $toUserId;

        return $this->send('delete', 'v1/users/'."{$userId}/friends", $params);
    }
}
