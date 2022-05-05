<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-26 22:26
 */

namespace whereof\easyIm\RongCloud\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 历史消息
 * https://doc.rongcloud.cn/imserver/server/v1/message/storage
 * Class HistoryClient.
 *
 * @author qmister
 */
class HistoryClient extends RongCloudClient
{
    /**
     * 查询历史记录.
     *
     * @param int $date 指定北京时间某天某小时，格式为 2014010101，表示获取 2014 年 1 月 1 日凌晨 1 点至 2 点的数据。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($date)
    {
        $params = [
            'date' => $date,
        ];

        return $this->send('message/history.json', $params);
    }

    /**
     * 消息清除.
     *
     * @param $userId
     * @param $targetId
     * @param int    $conversationType 会话类型，支持单聊、群聊、系统会话。单聊会话是 1、群组会话是 3、系统通知是 6
     * @param string $msgTimestamp     清除该时间戳之前的所有历史消息，精确到毫秒，为空时清除该会话的所有历史消息。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function clean($userId, $targetId, $conversationType, $msgTimestamp)
    {
        $params = [
            'conversationType' => $conversationType,
            'fromUserId'       => $userId,
            'targetId'         => $targetId,
            'msgTimestamp'     => $msgTimestamp,
        ];

        return $this->send('conversation/message/history/clean.json', $params);
    }
}
