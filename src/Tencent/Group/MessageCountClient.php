<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-19 00:12
 */

namespace whereof\easyIm\Tencent\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\GroupMessageCountInterface;
use whereof\easyIm\Tencent\Request\TencentClient;

/**
 * Class MessageCountClient
 * @author qmister
 * @package whereof\easyIm\Tencent\Group
 */
class MessageCountClient extends TencentClient implements GroupMessageCountInterface
{
    /**
     * 设置成员未读消息计数
     * https://cloud.tencent.com/document/product/269/1637.
     *
     * @param $groupId
     * @param $userId
     * @param $number
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function setUnreadNum($groupId, $userId, $number)
    {
        $params = [
            'GroupId'        => (string) $groupId,
            'Member_Account' => (string) $userId,
            'UnreadMsgNum'   => $number,
        ];

        return $this->send('group_open_http_svc/set_unread_msg_num', $params);
    }

    /**
     * 获取直播群在线人数
     * https://cloud.tencent.com/document/product/269/49180.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getOnlineUserNum($groupId)
    {
        $params = [
            'GroupId' => (string) $groupId,
        ];

        return $this->send('group_open_http_svc/get_online_member_num', $params);
    }
}
