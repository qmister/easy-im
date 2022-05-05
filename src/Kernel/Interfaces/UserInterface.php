<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 22:38
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * @author qmister
 * Interface UserInterface
 */
interface UserInterface
{
    /**
     * 将用户同步到云平台.
     *
     * @param $userId
     *
     * @return mixed
     */
    public function create($userId);

    /**
     * 用户详情.
     *
     * @param $userId
     *
     * @return mixed
     */
    public function info($userId);

    /**
     * 删除用户.
     *
     * @param $userId
     *
     * @return mixed
     */
    public function delete($userId);

    /**
     * 用户在线情况查看.
     *
     * @param $userId
     *
     * @return mixed
     */
    public function status($userId);

    /**
     * 过期用户登陆信息.
     *
     * @param $userId
     *
     * @return mixed
     */
    public function expire($userId);
}
