<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-19 22:01
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * @author qmister
 * Interface UserFriendInterface
 */
interface UserFriendInterface
{
    /**
     * 查询关系.
     *
     * @param $userId
     *
     * @return mixed
     */
    public function query($userId);

    /**
     * 建立关系.
     *
     * @param $userId
     * @param $toUserId
     *
     * @return mixed
     */
    public function addTo($userId, $toUserId);

    /**
     * 移除关系.
     *
     * @param $userId
     * @param $toUserId
     *
     * @return mixed
     */
    public function remove($userId, $toUserId);
}
