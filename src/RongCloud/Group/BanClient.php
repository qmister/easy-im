<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-27 22:29
 */

namespace whereof\easyIm\RongCloud\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 全体禁言
 * https://doc.rongcloud.cn/imserver/server/v1/group/groupblock
 * Class GroupBanClient.
 *
 * @author qmister
 */
class BanClient extends RongCloudClient
{
    /**
     * 获取全体成员禁言群.
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

        return $this->send('group/ban/query.json', $params);
    }

    /**
     * 添加全体成员禁言
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function add($groupId)
    {
        $params = [
            'groupId' => $groupId,
        ];

        return $this->send('group/ban/add.json', $params);
    }

    /**
     * 移除全体成员禁言
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function rollback($groupId)
    {
        $params = [
            'groupId' => $groupId,
        ];

        return $this->send('group/ban/rollback.json', $params);
    }

    /**
     * 获取全体成员禁言群.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryWhitelist($groupId)
    {
        $params = [
            'groupId' => $groupId,
        ];

        return $this->send('group/ban/whitelist/query.json', $params);
    }

    /**
     * 添加禁言白名单.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function whitelistAdd($groupId, $userId)
    {
        $params = [
            'groupId' => $groupId,
            'userId'  => $userId,
        ];

        return $this->send('group/ban/whitelist/add.json', $params);
    }

    /**
     * 移除全体成员禁言
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function whitelistRollback($groupId, $userId)
    {
        $params = [
            'groupId' => $groupId,
            'userId'  => $userId,
        ];

        return $this->send('group/ban/whitelist/rollback.json', $params);
    }
}
