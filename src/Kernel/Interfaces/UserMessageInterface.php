<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-20 21:11
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * @author zhiqiang
 * Interface UserMessageInterface
 */
interface UserMessageInterface
{
    /**
     * 拉消息.
     *
     * @param $userId
     * @param $toUserId
     *
     * @return mixed
     */
    public function queryMessage($userId, $toUserId);

    /**
     * 发送消息.
     *
     * @param $userId
     * @param array $messageBody
     *
     * @return mixed
     */
    public function sendMessage($userId, array $messageBody);

    /**
     * 撤回消息.
     *
     * @param $messageId
     * @param string $userId
     * @param string $targetId
     *
     * @return mixed
     */
    public function recallForMsgId($messageId, $userId, $targetId);
}
