<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-25 22:43
 */

namespace whereof\easyIm\RongCloud\System;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 标签用户通知/应用包名通知
 * Class UserTagPushClient.
 *
 * @author zhiqiang
 */
class PushClient extends RongCloudClient
{
    /**
     * 发送标签通知/应用包名通知.
     *
     * @param string $userId       发送人用户 Id。
     * @param array  $audience     推送条件，包括： tag、userid、is_to_all。
     *                             用户标签 "audience":{"tag":["女","年轻"],"tag_or":["北京","上海"],"userid":["123","456"],"is_to_all":false},
     *                             应用包名通知 "audience":{"packageName":"xxx.rong.xxx","is_to_all":false},
     * @param array  $message
     *                             "message": {"content": "{\"content\":\"1111\",\"extra\":\"aa\"}","objectName": "RC:TxtMsg"},
     * @param array  $notification
     *                             "title":"标题","forceShowPushContent":0,"alert":"this is a push",
     *                             "ios":{"alert": "override alert","thread-id":"223","apns-collapse-id":"111","extras": {"id": "1","name": "2"}},
     *                             "android": {"alert": "override alert","hw":{"channelId":"NotificationKanong","importance": "NORMAL"},
     *                             "mi":{"channelId":"rongcloud_kanong"},
     *                             "oppo":{"channelId":"rc_notification_id"},
     *                             "vivo":{"classification":"0"},"extras": {"id": "1","name": "2"}}
     * @param array  $platform
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function push($userId, array $audience, array $message, array $notification, $platform = ['ios', 'android'])
    {
        $params = [
            'platform'     => $platform,
            'fromuserid'   => $userId,
            'audience'     => $audience,
            'message'      => $message,
            'notification' => $notification,
        ];

        return $this->send('push.json', $params);
    }
}
