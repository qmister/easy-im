<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-26 22:19
 */

namespace whereof\easyIm\RongCloud\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 消息扩展
 * https://doc.rongcloud.cn/imserver/server/v1/message/expansion
 * Class SetMessageClient.
 *
 * @author zhiqiang
 */
class SetMessageClient extends RongCloudClient
{
    /**
     * 获取扩展信息.
     *
     * @param $msgUID
     * @param int $pageNo
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($msgUID, $pageNo = 300)
    {
        $params = [
            'msgUID' => $msgUID,
            'pageNo' => $pageNo,
        ];

        return $this->send('message/expansion/query.json', $params);
    }

    /**
     * 设置消息扩展.
     *
     * @param string $msgUID           消息唯一标识 ID，服务端可通过全量消息路由功能获取。
     * @param string $userId           需要设置扩展的消息发送用户 Id。
     * @param string $conversationType 会话类型，二人会话是 1 、群组会话是 3，只支持单聊、群组会话类型。
     * @param string $targetId         目标 Id，根据不同的 conversationType，可能是用户 Id 或群组 Id。
     * @param string $extraKeyVal      消息自定义扩展内容，JSON 结构，以 Key、Value 的方式进行设置，如：{"type":"3"}，单条消息可设置 300 个扩展信息，一次最多可以设置 100 个。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function set($msgUID, $userId, $conversationType, $targetId, $extraKeyVal)
    {
        $params = [
            'msgUID'           => $msgUID,
            'userId'           => $userId,
            'conversationType' => $conversationType,
            'targetId'         => $targetId,
            'extraKeyVal'      => $extraKeyVal,
        ];

        return $this->send('message/expansion/set.json', $params);
    }

    /**
     * 删除消息扩展.
     *
     * @param string $msgUID           消息唯一标识 ID，服务端可通过全量消息路由功能获取。
     * @param string $userId           需要设置扩展的消息发送用户 Id。
     * @param string $conversationType 会话类型，二人会话是 1 、群组会话是 3，只支持单聊、群组会话类型。
     * @param string $targetId         目标 Id，根据不同的 conversationType，可能是用户 Id 或群组 Id。
     * @param string $extraKeyVal      消息自定义扩展内容，JSON 结构，以 Key、Value 的方式进行设置，如：{"type":"3"}，单条消息可设置 300 个扩展信息，一次最多可以设置 100 个。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function delete($msgUID, $userId, $conversationType, $targetId, $extraKeyVal)
    {
        $params = [
            'msgUID'           => $msgUID,
            'userId'           => $userId,
            'conversationType' => $conversationType,
            'targetId'         => $targetId,
            'extraKeyVal'      => $extraKeyVal,
        ];

        return $this->send('message/expansion/delete.json', $params);
    }
}
