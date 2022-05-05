<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-26 21:15
 */

namespace whereof\easyIm\RongCloud\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 发送单聊消息
 * https://doc.rongcloud.cn/imserver/server/v1/message/msgsend/private-p
 * Class MessageClient.
 *
 * @author qmister
 */
class UserMessageClient extends RongCloudClient
{
    /**
     * 普通消息发送
     * content={"content":"hello","extra":"helloExtra"}&fromUserId=2191&toUserId=2193&toUserId=2192&objectName=RC:TxtMsg&pushContent=thisisapush&pushData={"pushData":"hello"}&count=4&verifyBlacklist=0&isPersisted=1&isIncludeSender=0&disablePush=false&expansion=false.
     *
     * @param string       $userId          发送人用户 Id。
     * @param string|array $toUserId        接收用户 Id，可以实现向多人发送消息，每次上限为 1000 人。
     * @param string       $objectName      消息类型
     * @param array        $content         发送消息内容
     * @param array        $pushContent     自定义显示的 Push 内容
     * @param array        $pushData        Push 透传信息
     * @param int          $isIncludeSender 终端用户在线状态下，发送者是否接收该消息，0 表示为不接收，1 表示为接收，默认为 0 不接收，只有在 toUserId 为一个用户 Id 的时候有效，不为 1 时该消息不会存储到历史消息中。如终端用户未登录，需要登录后也收到此条消息时，需要在开发者后台 IM 商用版中开通“多设备消息同步”功能。
     * @param int          $count           仅目标用户为 iOS 设备有效，Push 时用来控制桌面角标未读消息数，只有在 toUserId 为一个用户 Id 时有效，客户端获取远程推送内容时为 badge 查看详细，为 -1 时不改变角标数，传入相应数字表示把角标数改为指定的数字，最大不超过 9999。
     * @param int          $verifyBlacklist 是否过滤接收用户黑名单列表，0 表示为不过滤、 1 表示为过滤，默认为 0。
     * @param int          $isPersisted     针对融云服务端历史消息中是否存储此条消息，客户端则根据消息注册的 ISPERSISTED 标识判断是否存储；针对自定义消息，如果旧版客户端上未注册该消息时，根据此属性确定是否存储在本地，但无法解析显示。0 表示为不存储、 1 表示为存储，默认为 1 存储消息，此属性不影响离线消息功能，用户未在线时都会转为离线消息存储。
     * @param bool         $expansion       是否为可扩展消息，默认为 false，设为 true 时终端在收到该条消息后，可对该条消息设置扩展信息。
     * @param bool         $disablePush     是否为静默消息，默认为 false，设为 true 时终端用户离线情况下不会收到通知提醒。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function push(string $userId, $toUserId, string $objectName, $content = [], $pushContent = [], $pushData = [], $isIncludeSender = 0, $count = 0, $verifyBlacklist = 0, $isPersisted = 1, $expansion = false, $disablePush = false)
    {
        $params = [
            'fromUserId'      => $userId,
            'toUserId'        => $toUserId,
            'objectName'      => $objectName,
            'content'         => $content,
            'isIncludeSender' => $isIncludeSender,
            'verifyBlacklist' => $verifyBlacklist,
            'isPersisted'     => $isPersisted,
            'disablePush'     => $disablePush,
            'expansion'       => $expansion,
        ];
        if ($pushContent) {
            $params['pushContent'] = $pushContent;
        }
        if ($pushData) {
            $params['pushData'] = $pushData;
        }
        if ($count) {
            $params['count'] = $count;
        }

        return $this->send('message/private/publish.json', $params);
    }

    /**
     * 模板消息发送
     *
     * @param string       $userId          发送人用户 Id
     * @param string|array $toUserId        接收用户 Id，提供多个本参数可以实现向多人发送消息，上限为 1000 人。
     * @param string       $objectName      消息类型
     * @param string|array $values          消息内容中，标识位对应内容。
     * @param string|array $content         发送消息内容，单条消息最大 128k，内置消息以 JSON 方式进行数据序列化，消息中可选择是否携带用户信息，详见消息结构示例；如果 objectName 为自定义消息类型，该参数可自定义格式，不限于 JSON。
     * @param array        $pushContent     定义显示的 Push 内容，如果 objectName 为融云内置消息类型时，Push 内容不需要进行自定义。
     * @param array        $pushData        针对 iOS 平台为 Push 通知时附加到 payload 中，客户端获取远程推送内容时为 appData，同时融云默认携带了消息基本信息，客户端可通过 ‘rc’ 属性获取，查看详细。
     * @param int          $verifyBlacklist 是否过滤发送人黑名单列表，0 为不过滤、 1 为过滤，默认为 0 不过滤。
     * @param int          $isPersisted     针对融云服务端历史消息中是否存储此条消息，客户端则根据消息注册的 ISPERSISTED 标识判断是否存储；针对自定义消息，如果旧版客户端上未注册该消息时，根据此属性确定是否存储在本地，但无法解析显示。0 表示为不存储、 1 表示为存储，默认为 1 存储消息，此属性不影响离线消息功能，用户未在线时都会转为离线消息存储。
     * @param bool         $disablePush     是否为静默消息，默认为 false，设为 true 时终端用户离线情况下不会收到通知提醒。
     * @param bool         $expansion       是否为可扩展消息，默认为 false，设为 true 时终端在收到该条消息后，可对该条消息设置扩展信息。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function publishTemplate($userId, $toUserId, $objectName, $values, $content, $pushContent = [], $pushData = [], $verifyBlacklist = 0, $isPersisted = 1, $disablePush = false, $expansion = false)
    {
        $params = [
            'fromUserId'      => $userId,
            'toUserId'        => $toUserId,
            'objectName'      => $objectName,
            'values'          => $values,
            'content'         => $content,
            'verifyBlacklist' => $verifyBlacklist,
            'isPersisted'     => $isPersisted,
            'disablePush'     => $disablePush,
            'expansion'       => $expansion,
        ];
        if ($pushContent) {
            $params['pushContent'] = $pushContent;
        }
        if ($pushData) {
            $params['pushData'] = $pushData;
        }

        return $this->send('message/private/publish_template.json', $params);
    }
}
