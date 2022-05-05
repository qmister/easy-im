<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 22:38
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * @author qmister
 * Interface UserFrientGroupInterface
 */
interface UserFrientGroupInterface
{
    /**
     * @param $userId
     *
     * @return mixed
     */
    public function query($userId);

    /**
     * @param $userId
     * @param $groupId
     *
     * @return mixed
     */
    public function add($userId, $groupId);

    /**
     * @param $userId
     * @param $groupId
     *
     * @return mixed
     */
    public function delete($userId, $groupId);
}
