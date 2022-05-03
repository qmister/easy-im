<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-25 21:49
 */

namespace whereof\easyIm\RongCloud\Setting;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 用户单聊禁言
 * https://doc.rongcloud.cn/imserver/server/v1/user/ban
 * Class SpeakingClient.
 *
 * @author zhiqiang
 */
class SpeakingClient extends RongCloudClient
{
    /**
     * 查询禁言用户列表.
     *
     * @param int    $offset
     * @param int    $num
     * @param string $type
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($offset = 0, $num = 100, $type = 'PERSON')
    {
        $params = [
            'num'     => $num,
            'offset'  => $offset,
            'type'    => $type,
        ];

        return $this->send('user/chat/fb/set.json', $params);
    }

    /**
     * 设置用户禁言
     *
     * @param string $userId 被禁言用户 Id，支持批量设置，最多不超过 1000 个。
     * @param int    $state  禁言状态，0 解除禁言、1 添加禁言
     * @param string $type   会话类型，目前支持单聊会话 PERSON
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function set($userId, $state = 1, $type = 'PERSON')
    {
        $params = [
            'userId' => $userId,
            'state'  => $state,
            'type'   => $type,
        ];

        return $this->send('user/chat/fb/set.json', $params);
    }
}
