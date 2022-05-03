<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-25 22:38
 */

namespace whereof\easyIm\RongCloud\System;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * Class BroadcastClient.
 *
 * @author zhiqiang
 */
class BroadcastClient extends RongCloudClient
{
    /**
     * 在线广播消息
     * https://doc.rongcloud.cn/imserver/server/v1/system/online.
     *
     * @param string $userId     发送人用户 Id。
     * @param string $objectName 消息类型
     * @param string $content    发送消息内容，单条消息最大 128k，内置消息以 JSON 方式进行数据序列化，消息中可选择是否携带用户信息，详见消息结构示例；如果 objectName 为自定义消息类型，该参数可自定义格式，不限于 JSON。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function push($userId, $objectName, $content)
    {
        $params = [
            'fromUserId' => $userId,
            'objectName' => $objectName,
            'content'    => $content,
        ];

        return $this->send('message/online/broadcast.json', $params);
    }

    /**
     * 全量用户通知
     * https://doc.rongcloud.cn/imserver/server/v1/system/broadcast.
     *
     * @param string $userId           发送人用户 Id。
     * @param string $objectName       消息类型
     * @param array  $content          发送消息内容
     * @param array  $pushContent      定义显示的 Push 内容
     * @param array  $pushData         针对 iOS 平台为 Push 通知时附加到 payload 中，客户端获取远程推送内容时为 appData，同时融云默认携带了消息基本信息，客户端可通过 ‘rc’ 属性获取，查看详细，Android 客户端收到推送消息时对应字段名为 pushData。
     * @param int    $contentAvailable 针对 iOS 平台，对 SDK 处于后台暂停状态时为静默推送，是 iOS7 之后推出的一种推送方式。 允许应用在收到通知后在后台运行一段代码，且能够马上执行，查看详细。1 表示为开启，0 表示为关闭，默认为 0
     * @param array  $pushExt          推送通知属性设置，详细查看 pushExt 参数说明，pushExt 为 JSON 结构请求时需要做转义处理。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function allPush($userId, $objectName, $content, $pushContent, $pushData, $contentAvailable = 0, $pushExt = [])
    {
        $params = [
            'fromUserId'       => $userId,
            'objectName'       => $objectName,
            'content'          => $content,
            'pushContent'      => $pushContent,
            'pushData'         => $pushData,
            'contentAvailable' => $contentAvailable,
            'pushExt'          => $pushExt,
        ];

        return $this->send('message/broadcast.json', $params);
    }
}
