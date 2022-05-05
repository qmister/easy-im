<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-26 22:11
 */

namespace whereof\easyIm\RongCloud\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 发送聊天室消息
 * https://doc.rongcloud.cn/imserver/server/v1/message/msgsend/chatroom-p
 * Class ChatroomMessageClient.
 *
 * @author qmister
 */
class ChatroomMessageClient extends RongCloudClient
{
    /**
     * @param $userId
     * @param $toChatroomId
     * @param $objectName
     * @param $content
     * @param int $isPersisted
     * @param int $isIncludeSender
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function push($userId, $toChatroomId, $objectName, $content, $isPersisted = 1, $isIncludeSender = 0)
    {
        $params = [
            'fromUserId'      => $userId,
            'toChatroomId'    => $toChatroomId,
            'objectName'      => $objectName,
            'content'         => $content,
            'isPersisted'     => $isPersisted,
            'isIncludeSender' => $isIncludeSender,
        ];

        return $this->send('message/chatroom/publish.json', $params);
    }

    /**
     * 广播消息.
     *
     * @param $userId
     * @param $objectName
     * @param $content
     * @param int $isIncludeSender
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function broadcast($userId, $objectName, $content, $isIncludeSender = 0)
    {
        $params = [
            'fromUserId'      => $userId,
            'objectName'      => $objectName,
            'content'         => $content,
            'isIncludeSender' => $isIncludeSender,
        ];

        return $this->send('message/chatroom/broadcast.json', $params);
    }
}
