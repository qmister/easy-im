<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-26 22:29
 */

namespace whereof\easyIm\RongCloud\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * 消息撤回
 * https://doc.rongcloud.cn/imserver/server/v1/message/msgrecall
 * Class RecallClient.
 *
 * @author zhiqiang
 */
class RecallClient extends RongCloudClient
{
    /**
     * @param $userId
     * @param $conversationType
     * @param $targetId
     * @param $messageUID
     * @param $sentTime
     * @param int  $isAdmin
     * @param int  $isDelete
     * @param bool $disablePush
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
     * @param $userId
     * @param $messageUID
     * @param $sentTime
     * @param int  $isAdmin
     * @param int  $isDelete
     * @param bool $disablePush
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function allRecall($userId, $messageUID, $sentTime, $isAdmin = 0, $isDelete = 0, $disablePush = false)
    {
        $params = [
            'fromUserId'       => $userId,
            'messageUID'       => $messageUID,
            'sentTime'         => $sentTime,
            'isAdmin'          => $isAdmin,
            'isDelete'         => $isDelete,
            'disablePush'      => $disablePush,
        ];

        return $this->send('message/broadcast/recall.json', $params);
    }
}
