<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-27 21:55
 */

namespace whereof\easyIm\RongCloud\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 群组
 * https://doc.rongcloud.cn/imserver/server/v1/group/basic
 * Class GroupClient.
 *
 * @author zhiqiang
 */
class Client extends RongCloudClient
{
    /**
     * 群组成员查询.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryUserByGroupId($groupId)
    {
        $params = [
            'groupId' => $groupId,
        ];

        return $this->send('group/user/query.json', $params);
    }

    /**
     * 查询用户所在群组.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryGroupByUserId($userId)
    {
        $params = [
            'userId' => $userId,
        ];

        return $this->send('user/group/query.json', $params);
    }

    /**
     * 创建群.
     *
     * @param string $groupId   群组标识
     * @param array  $userList  要加入群的用户 Id，最多不超过 1000 个。
     * @param string $groupName
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create($groupId, $userList, $groupName = '')
    {
        $params = [
            'userId'    => $userList,
            'groupId'   => $groupId,
            'groupName' => empty($groupName) ? $groupName : $groupId,
        ];

        return $this->send('group/create.json', $params);
    }

    /**
     * 删除（解散群）.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function destroy($groupId, $userId)
    {
        $params = [
            'userId'  => $userId,
            'groupId' => $groupId,
        ];

        return $this->send('group/dismiss.json', $params);
    }

    /**
     * 刷新群组信息.
     *
     * @param $groupId
     * @param $groupName
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function refresh($groupId, $groupName)
    {
        $params = [
            'groupId'   => $groupId,
            'groupName' => $groupName,
        ];

        return $this->send('group/refresh.json', $params);
    }

    /**
     * 加入群组.
     *
     * @param $userId
     * @param $groupId
     * @param $groupName
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function join($userId, $groupId, $groupName)
    {
        $params = [
            'userId'    => $userId,
            'groupId'   => $groupId,
            'groupName' => $groupName,
        ];

        return $this->send('group/join.json', $params);
    }

    /**
     * 退出群组.
     *
     * @param $userId
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function quit($userId, $groupId)
    {
        $params = [
            'userId'  => $userId,
            'groupId' => $groupId,
        ];

        return $this->send('group/quit.json', $params);
    }

    /**
     * 同步用户群组
     * userId=2014&group[10001]=TestGroup1&group[10002]=TestGroup2&group[10003]=TestGroup3.
     *
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function sync($params)
    {
        return $this->send('group/sync.json', $params);
    }
}
