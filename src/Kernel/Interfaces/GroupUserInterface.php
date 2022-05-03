<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-18 16:49
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * 群组与用户之间到关系处理.
 *
 * @author zhiqiang
 * Interface GroupUserInterface
 */
interface GroupUserInterface
{
    /**
     * 查询用户所加分组.
     *
     * @param $userId
     *
     * @return mixed
     */
    public function queryUserIdGroups($userId);

    /**
     * 查询群下的用户列表.
     *
     * @param $groupId
     *
     * @return mixed
     */
    public function queryGroupUsers($groupId);

    /**
     * 更改群的所有者.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function changeOwner($groupId, $userId);

    /**
     * 用户加入群组.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function addUser($groupId, $userId);

    /**
     * 用户退出群组.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function deleteUser($groupId, $userId);

    /**
     * 任命管理员.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function addManager($groupId, $userId);

    /**
     * 移除管理员.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function removeManager($groupId, $userId);

    /**
     * 修改群成员信息.
     *
     * @param $groupId
     * @param $userId
     * @param array $userInfo
     *
     * @return mixed
     */
    public function modifyUser($groupId, $userId, array $userInfo);

    /**
     * 查询禁言用户.
     *
     * @param $groupId
     *
     * @return mixed
     */
    public function queryMuteUser($groupId);

    /**
     * 禁言用户.
     *
     * @param $groupId
     * @param $userId
     * @param $time
     *
     * @return mixed
     */
    public function muteUser($groupId, $userId, $time);

    /**
     * 解禁用.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function unMuteUser($groupId, $userId);
}
