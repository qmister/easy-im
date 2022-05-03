<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-25 23:09
 */

namespace whereof\easyIm\RongCloud\System;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 通知撤回
 * Class RecallClient.
 *
 * @author zhiqiang
 */
class RecallClient extends RongCloudClient
{
    /**
     * 通知撤回.
     *
     * @param string $userId           消息发送人用户 Id。
     * @param int    $conversationType 会话类型，二人会话是 1 、群组会话是 3 、聊天室会话是 4、系统会话是 6。
     * @param string $targetId         目标 Id，根据不同的 ConversationType，可能是用户 Id、群组 Id、聊天室 Id、系统会话 Id。
     * @param string $messageUID       消息唯一标识，可通过服务端实时消息路由获取，对应名称为 msgUID。
     * @param int    $sentTime         消息发送时间，可通过服务端实时消息路由获取，对应名称为 msgTimestamp。
     * @param int    $isAdmin          是否为管理员，默认为 0，设为 1 时，IMKit 收到此条消息后，小灰条默认显示为“管理员 撤回了一条消息”。
     * @param int    $isDelete         默认为 0 撤回该条消息同时，用户端将该条消息删除并替换为一条小灰条撤回提示消息；为 1 时，该条消息删除后，不替换为小灰条提示消息。
     * @param bool   $disablePush      是否为静默撤回，默认为 false，设为 true 时终端用户离线情况下不会收到撤回通知提醒。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function recall($userId, $conversationType, $targetId, $messageUID, $sentTime, $isAdmin = 0, $isDelete = 0, $disablePush = false)
    {
        $params = [
            'fromUserId'       => $userId,
            'conversationType' => $conversationType,
            'targetId'         => $targetId,
            'messageUID'       => $messageUID,
            'sentTime'         => $sentTime,
            'isAdmin'          => $isAdmin,
            'isDelete'         => $isDelete,
            'disablePush'      => $disablePush,
        ];

        return $this->send('message/recall.json', $params);
    }

    /**
     * 全量落地通知撤回.
     *
     * @param $userId
     * @param $messageUID
     * @param $sentTime
     * @param int $isAdmin
     * @param int $isDelete
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function allRecall($userId, $messageUID, $sentTime, $isAdmin = 0, $isDelete = 0)
    {
        $params = [
            'fromUserId' => $userId,
            'messageUID' => $messageUID,
            'sentTime'   => $sentTime,
            'isAdmin'    => $isAdmin,
            'isDelete'   => $isDelete,
        ];

        return $this->send('message/broadcast/recall.json', $params);
    }
}
