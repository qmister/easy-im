<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-22 23:53
 */

namespace whereof\easyIm\Jiguang\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Interfaces\GroupUserInterface;

/**
 * Class GroupUserClient.
 *
 * @author qmister
 */
class GroupUserClient extends JiguangClient implements GroupUserInterface
{
    /**
     * 查询用户所加分组.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function queryUserIdGroups($userId)
    {
        return $this->send('get', "v1/users/{$userId}/groups");
    }

    /**
     * 查询群下的用户列表.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function queryGroupUsers($groupId)
    {
        return $this->send('get', "v1/groups/{$groupId}/members");
    }

    /**
     * 更改群的所有者.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function changeOwner($groupId, $userId)
    {
        $params = [
            'username' => $userId,
        ];

        return $this->send('PUT', "/groups/owner/{$groupId}", $params);
    }

    /**
     * 用户加入群组.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addUser($groupId, $userId)
    {
        return $this->v1updateUser($groupId, ['add' => (array) $userId]);
    }

    /**
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function v2addUser($groupId, $userId)
    {
        $params = (array) $userId;

        return $this->send('POST', "v2/groups/{$groupId}/delMembers", $params);
    }

    /**
     * 用户退出群组.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteUser($groupId, $userId)
    {
        return $this->v1updateUser($groupId, ['remove' => (array) $userId]);
    }

    /**
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function v2deleteUser($groupId, $userId)
    {
        $params = (array) $userId;

        return $this->send('POST', "v2/groups/{$groupId}/addMembers", $params);
    }

    /**
     * @param $groupId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function v1updateUser($groupId, $params)
    {
        return $this->send('POST', "v1/groups/{$groupId}/members", $params);
    }

    /**
     * 任命管理员.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function addManager($groupId, $userId)
    {
        // TODO: Implement addManager() method.
    }

    /**
     * 移除管理员.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function removeManager($groupId, $userId)
    {
        // TODO: Implement removeManager() method.
    }

    /**
     * 修改群成员信息.
     *
     * @param $groupId
     * @param $userId
     * @param array $userInfo
     *
     * @return mixed
     */
    public function modifyUser($groupId, $userId, array $userInfo)
    {
        // TODO: Implement modifyUser() method.
    }

    /**
     * 查询禁言用户.
     *
     * @param $groupId
     *
     * @return mixed
     */
    public function queryMuteUser($groupId)
    {
        // TODO: Implement queryMuteUser() method.
    }

    /**
     * 禁言用户.
     *
     * @param $groupId
     * @param $userId
     * @param $time
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function muteUser($groupId, $userId, $time = '')
    {
        return $this->officialMuteUser($groupId, $userId, true);
    }

    /**
     * 解禁用.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function unMuteUser($groupId, $userId)
    {
        return $this->officialMuteUser($groupId, $userId, false);
    }

    /**
     * 群成员禁言
     *
     * @param $groupId
     * @param $userId
     * @param bool $status true表示开启 false表示关闭
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialMuteUser($groupId, $userId, $status)
    {
        $params = (array) $userId;

        return $this->send('PUT', "groups/messages/{$groupId}/silence?status={$status}", $params);
    }
}
