<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-22 22:48
 */

namespace whereof\easyIm\Jiguang\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Interfaces\UserFriendInterface;

/**
 * 黑名单
 * Class UserblackClient.
 *
 * @author qmister
 */
class UserBlackClient extends JiguangClient implements UserFriendInterface
{
    protected $v1action = 'v1/users/';

    /**
     * 查询.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function query($userId)
    {
        return $this->send('get', 'v1/users/'."{$userId}/blacklist");
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

        return $this->send('PUT', 'v1/users/'."{$userId}/blacklist", $params);
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

        return $this->send('delete', 'v1/users/'."{$userId}/blacklist", $params);
    }
}
