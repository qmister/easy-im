<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-23 09:19
 */

namespace whereof\easyIm\Jiguang\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class UserGroupClient.
 *
 * @author zhiqiang
 */
class UserGroupClient extends JiguangClient
{
    /**
     * @param $userId
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function shield($userId, $groupId)
    {
        return $this->officialShield($userId, ['add' => $groupId]);
    }

    /**
     * @param $userId
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function unShield($userId, $groupId)
    {
        return $this->officialShield($userId, ['remove' => $groupId]);
    }

    /**
     * 群消息屏蔽.
     *
     * @param $userId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialShield($userId, $params)
    {
        return $this->send('post', "v1/users/{$userId}/groupsShield", $params);
    }
}
