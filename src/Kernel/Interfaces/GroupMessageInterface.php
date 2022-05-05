<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-18 23:11
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * @author qmister
 * Interface GroupMessage
 */
interface GroupMessageInterface
{
    /**
     * 拉群消息.
     *
     * @param $groupId
     *
     * @return mixed
     */
    public function queryMessage($groupId);

    /**
     * 发送群消息.
     *
     * @param $groupId
     * @param array $messageBody
     *
     * @return mixed
     */
    public function sendMessage($groupId, array $messageBody);

    /**
     * 撤回群消息.
     *
     * @param $groupId
     * @param $messageId
     *
     * @return mixed
     */
    public function recallForMsgId($groupId, $messageId);

    /**
     * 撤回指定人发送的消息.
     *
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function recallForUserId($groupId, $userId);
}
