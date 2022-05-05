<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-22 23:10
 */

namespace whereof\easyIm\Jiguang\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Interfaces\GroupInterface;

/**
 * Class GroupClient.
 *
 * @author qmister
 */
class GroupClient extends JiguangClient implements GroupInterface
{
    const TYPE_PUBLIC = 2;
    const TYPE_PRIVATE = 1;

    /**
     * 所有群组.
     *
     * @param int $start
     * @param int $count
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function groupList($start = 0, $count = 500)
    {
        return $this->send('get', "v1/groups?start={$start}&count={$count}");
    }

    /**
     * 创建群.
     *
     * @param string     $groupName 群组标识
     * @param string     $userId    群主
     * @param array      $userList  群成员
     * @param string|int $type      群类型
     * @param string     $desc      描述
     * @param string     $avatar    头像
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create($groupName, $userId = 'easyIm', $userList = [], $type = GroupClient::TYPE_PRIVATE, $desc = '', $avatar = '')
    {
        $params = [
            'owner_username' => $userId,
            'name'           => $groupName,
            'flag'           => $type,
        ];
        if ($desc) {
            $params['desc'] = $desc;
        }
        if ($avatar) {
            $params['avatar'] = $avatar;
        }
        if ($userList) {
            $params['members_username'] = $userList;
        }

        return $this->send('PUT', 'v1/groups/', $params);
    }

    /**
     * 群信息.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function info($groupId)
    {
        return $this->send('get', 'v1/groups/'."{$groupId}");
    }

    /**
     * 修改群.
     *
     * @param $groupId
     * @param string $name
     * @param string $desc
     * @param string $avatar
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update($groupId, $name = '', $desc = '', $avatar = '')
    {
        $params = [];
        if ($name) {
            $params['name'] = $name;
        }
        if ($desc) {
            $params['desc'] = $desc;
        }
        if ($avatar) {
            $params['avatar'] = $avatar;
        }

        return $this->send('PUT', 'v1/groups/'."{$groupId}", $params);
    }

    /**
     * 删除（解散群）.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function destroy($groupId)
    {
        return $this->send('DELETE', 'v1/groups/'."{$groupId}");
    }
}
