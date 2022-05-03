<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-19 00:08
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * @author zhiqiang
 * Interface GroupMessageCount
 */
interface GroupMessageCountInterface
{
    /**
     * 设置成员未读消息计数.
     *
     * @param $groupId
     * @param $userId
     * @param $number
     *
     * @return mixed
     */
    public function setUnreadNum($groupId, $userId, $number);
}
