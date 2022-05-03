<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-27 22:23
 */

namespace whereof\easyIm\RongCloud\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 单人禁言
 * https://doc.rongcloud.cn/imserver/server/v1/group/memeberblock
 * Class GroupGagClient.
 *
 * @author zhiqiang
 */
class GagClient extends RongCloudClient
{
    /**
     * 获取禁言成员.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($groupId)
    {
        $params = [
            'groupId' => $groupId,
        ];

        return $this->send('group/user/gag/list.json', $params);
    }

    /**
     * 添加禁言成员.
     *
     * @param $groupId
     * @param $userId
     * @param $minute
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function add($groupId, $userId, $minute)
    {
        $params = [
            'groupId' => $groupId,
            'userId'  => $userId,
            'minute'  => $minute,
        ];

        return $this->send('group/user/gag/add.json', $params);
    }

    /**
     * 移除禁言成员.
     *
     * @param $userId
     * @param string $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function rollback($userId, $groupId = '')
    {
        $params = [
            'userId' => $userId,
        ];
        if ($groupId) {
            $params['groupId'] = $groupId;
        }

        return $this->send('group/user/gag/rollback.json', $params);
    }
}
