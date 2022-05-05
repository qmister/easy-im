<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-27 22:35
 */

namespace whereof\easyIm\RongCloud\Conversation;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 会话
 * Class ConversationClient.
 *
 * @author qmister
 */
class ConversationClient extends RongCloudClient
{
    /**
     * 会话置顶
     * https://doc.rongcloud.cn/imserver/server/v1/conversation/top.
     *
     * @param $userId
     * @param $targetId
     * @param $setTop
     * @param int $conversationType
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function topSet($userId, $targetId, $setTop, $conversationType = 6)
    {
        $params = [
            'userId'           => $userId,
            'conversationType' => $conversationType,
            'targetId'         => $targetId,
            'setTop'           => $setTop,
        ];

        return $this->send('conversation/top/set.json', $params);
    }

    /**
     * 设置会话消息免打扰
     * https://doc.rongcloud.cn/imserver/server/v1/conversation/notify.
     *
     * @param string|array $requestId        设置消息免打扰的用户 Id。
     * @param string|array $targetId         目标 Id，根据不同的 ConversationType，可能是用户 Id、群组 Id。
     * @param int          $isMuted          消息免打扰设置状态，0 表示为关闭，1 表示为开启。
     * @param int          $conversationType 会话类型，二人会话是 1 、群组会话是 3 、系统是 6。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function notificationSet($requestId, $targetId, $isMuted, $conversationType = 6)
    {
        $params = [
            'conversationType' => $conversationType,
            'requestId'        => $requestId,
            'targetId'         => $targetId,
            'isMuted'          => $isMuted,
        ];

        return $this->send('conversation/notification/set.json', $params);
    }

    /**
     * 设置会话消息免打扰
     * https://doc.rongcloud.cn/imserver/server/v1/conversation/notify.
     *
     * @param $requestId
     * @param $targetId
     * @param int $conversationType
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryNotification($requestId, $targetId, $conversationType = 6)
    {
        $params = [
            'conversationType' => $conversationType,
            'requestId'        => $requestId,
            'targetId'         => $targetId,
        ];

        return $this->send('conversation/notification/get.json', $params);
    }
}
