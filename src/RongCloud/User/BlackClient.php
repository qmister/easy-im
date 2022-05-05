<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-25 21:35
 */

namespace whereof\easyIm\RongCloud\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserFriendInterface;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 用户黑名单
 * https://doc.rongcloud.cn/imserver/server/v1/user/blacklist
 * Class UserBlackClient.
 *
 * @author qmister
 */
class BlackClient extends RongCloudClient implements UserFriendInterface
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
        $params = [
            'userId' => $userId,
        ];

        return $this->send('user/blacklist/query.json', $params);
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
        $params = [
            'userId'      => $userId,
            'blackUserId' => $toUserId,
        ];

        return $this->send('user/blacklist/add.json', $params);
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
        $params = [
            'userId'      => $userId,
            'blackUserId' => $toUserId,
        ];

        return $this->send('user/blacklist/remove.json', $params);
    }
}
