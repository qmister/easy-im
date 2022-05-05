<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-25 21:39
 */

namespace whereof\easyIm\RongCloud\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserFriendInterface;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 用户白名单
 * https://doc.rongcloud.cn/imserver/server/v1/user/whitelist
 * Class UserWhiteClient.
 *
 * @author qmister
 */
class WhiteClient extends RongCloudClient implements UserFriendInterface
{
    /**
     * @param $userId
     * @param int $whiteSetting
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function set($userId, $whiteSetting = 1)
    {
        $params = [
            'userId'       => $userId,
            'whiteSetting' => $whiteSetting,
        ];

        return $this->send('user/blacklist/query.json', $params);
    }

    /**
     * @param $userId
     * @param int $whiteSetting
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function querySet($userId)
    {
        $params = [
            'userId' => $userId,
        ];

        return $this->send('user/whitesetting/query.json', $params);
    }

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

        return $this->send('user/whitelist/query.json', $params);
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
            'whiteUserId' => $toUserId,
        ];

        return $this->send('user/whitelist/add.json', $params);
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
            'whiteUserId' => $toUserId,
        ];

        return $this->send('user/whitelist/remove.json', $params);
    }
}
