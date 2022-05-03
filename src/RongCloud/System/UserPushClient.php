<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-25 22:14
 */

namespace whereof\easyIm\RongCloud\System;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 单个用户通知
 * https://doc.rongcloud.cn/imserver/server/v1/system/private#publish
 * Class UserPushClient.
 *
 * @author zhiqiang
 */
class UserPushClient extends RongCloudClient
{
    /**
     * 单个用户发送-普通消息.
     *
     * @param string $userId           发送人用户 Id。
     * @param string $toUserId         接收用户Id，提供多个本参数可以实现向多用户发送系统消息，上限为 100 人。
     * @param string $objectName       消息类型
     * @param string $content          发送消息内容，单条消息最大 128k，内置消息以 JSON 方式进行数据序列化，消息中可选择是否携带用户信息，详见消息结构示例；如果 objectName 为自定义消息类型，该参数可自定义格式，不限于 JSON。
     * @param string $pushContent      定义显示的 Push 内容，如果 objectName 为融云内置消息类型时，则发送后用户一定会收到 Push 信息。 如果为自定义消息，则 pushContent 为自定义消息显示的 Push 内容，如果不传则用户不会收到 Push 通知。
     * @param int    $isPersisted      针对融云服务端历史消息中是否存储此条消息，客户端则根据消息注册的 ISPERSISTED 标识判断是否存储；针对自定义消息，如果旧版客户端上未注册该消息时，根据此属性确定是否存储在本地，但无法解析显示。0 表示为不存储、 1 表示为存储，默认为 1 存储消息，此属性不影响离线消息功能，用户未在线时都会转为离线消息存储。
     * @param int    $contentAvailable 针对 iOS 平台，对 SDK 处于后台暂停状态时为静默推送，是 iOS7 之后推出的一种推送方式。 允许应用在收到通知后在后台运行一段代码，且能够马上执行，查看详细。1 表示为开启，0 表示为关闭，默认为 0
     * @param bool   $disablePush      是否为静默消息，默认为 false，设为 true 时终端用户离线情况下不会收到通知提醒。
     * @param string $pushData         针对 iOS 平台为 Push 通知时附加到 payload 中，客户端获取远程推送内容时为 appData，同时融云默认携带了消息基本信息，客户端可通过 ‘rc’ 属性获取，查看详细，Android 客户端收到推送消息时对应字段名为 pushData。
     * @param array  $pushExt          推送通知属性设置，详细查看 pushExt 参数说明，pushExt 为 JSON 结构请求时需要做转义处理。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function push($userId, $toUserId, $objectName, $content, $pushContent, $isPersisted = 1, $contentAvailable = 0, $disablePush = false, $pushData = '', $pushExt = [])
    {
        $params = [
            'fromUserId'       => $userId,
            'toUserId'         => $toUserId,
            'objectName'       => $objectName,
            'content'          => $content,
            'pushContent'      => $pushContent,
            'isPersisted'      => $isPersisted,
            'contentAvailable' => $contentAvailable,
            'disablePush'      => $disablePush,
        ];
        if ($pushData) {
            $params['pushData'] = $pushData;
        }
        if ($pushExt) {
            $params['pushExt'] = $pushExt;
        }

        return $this->send('message/system/publish.json', $params);
    }

    /**
     * 单个用户发送-模板消息.
     *
     * @param string $userId           发送人用户 Id。
     * @param string $toUserId         接收用户Id，提供多个本参数可以实现向多用户发送系统消息，上限为 100 人。
     * @param string $objectName       消息类型
     * @param string $values           消息内容中，标识位对应内容。
     * @param string $content          发送消息内容，单条消息最大 128k，内置消息以 JSON 方式进行数据序列化，消息中可选择是否携带用户信息，详见消息结构示例；如果 objectName 为自定义消息类型，该参数可自定义格式，不限于 JSON。
     * @param string $pushContent      定义显示的 Push 内容，如果 objectName 为融云内置消息类型时，则发送后用户一定会收到 Push 信息。 如果为自定义消息，则 pushContent 为自定义消息显示的 Push 内容，如果不传则用户不会收到 Push 通知。
     * @param int    $isPersisted      针对融云服务端历史消息中是否存储此条消息，客户端则根据消息注册的 ISPERSISTED 标识判断是否存储；针对自定义消息，如果旧版客户端上未注册该消息时，根据此属性确定是否存储在本地，但无法解析显示。0 表示为不存储、 1 表示为存储，默认为 1 存储消息，此属性不影响离线消息功能，用户未在线时都会转为离线消息存储。
     * @param int    $contentAvailable 针对 iOS 平台，对 SDK 处于后台暂停状态时为静默推送，是 iOS7 之后推出的一种推送方式。 允许应用在收到通知后在后台运行一段代码，且能够马上执行，查看详细。1 表示为开启，0 表示为关闭，默认为 0
     * @param bool   $disablePush      是否为静默消息，默认为 false，设为 true 时终端用户离线情况下不会收到通知提醒。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function publishTemplate($userId, $toUserId, $objectName, $values, $content, $pushContent, $isPersisted = 1, $contentAvailable = 0, $disablePush = false)
    {
        $params = [
            'fromUserId'       => $userId,
            'toUserId'         => $toUserId,
            'objectName'       => $objectName,
            'values'           => $values,
            'content'          => $content,
            'pushContent'      => $pushContent,
            'isPersisted'      => $isPersisted,
            'contentAvailable' => $contentAvailable,
            'disablePush'      => $disablePush,
        ];

        return $this->send('message/system/publish_template.json', $params);
    }
}
