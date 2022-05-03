<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-19 00:02
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * @author zhiqiang
 * Interface GroupNotifyInterface
 */
interface GroupNotifyInterface
{
    /**
     * @param $groupId
     * @param $text
     *
     * @return mixed
     */
    public function sendNotify($groupId, $text);
}
