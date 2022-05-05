<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-21 22:44
 */

namespace whereof\easyIm\Tencent\Chat;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserMessageInterface;
use whereof\easyIm\Kernel\Support\Timer;
use whereof\easyIm\Tencent\Request\TencentClient;

/**
 * Class UserMessageClient
 * @author qmister
 * @package whereof\easyIm\Tencent\Chat
 */
class UserMessageClient extends TencentClient implements UserMessageInterface
{
    /**
     * 拉消息.
     *
     * @param $userId
     * @param $targetId
     * @param int    $maxCnt
     * @param int    $minTime
     * @param int    $maxTime
     * @param string $lastMsgKey
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function queryMessage($userId, $targetId, $maxCnt = 100, int $minTime = null, int $maxTime = null, $lastMsgKey = '')
    {
        $params = [
            'From_Account' => $userId,
            'To_Account'   => $targetId,
            'MaxCnt'       => $maxCnt,
            'MinTime'      => $minTime ?? time(),
            'MaxTime'      => $maxTime ?? strtotime(date('Y-m-d H:i:s', strtotime('-7 day'))),
        ];
        if ($lastMsgKey) {
            $params['LastMsgKey'] = $lastMsgKey;
        }

        return $this->send('openim/admin_getroammsg', $params);
    }

    //1：把消息同步到 From_Account 在线终端和漫游上；
    const SYNC_OTHER_MACHINE_YES = 1;
    //消息不同步至 From_Account
    const SYNC_OTHER_MACHINE_NO = 2;

    /**
     * 发送消息
     * https://cloud.tencent.com/document/product/269/2282.
     *
     * @param $userId
     * @param array  $messageBody
     * @param string $fromUserId       消息发送方 UserID（用于指定发送消息方帐号）
     * @param int    $syncOtherMachine 1：把消息同步到 From_Account 在线终端和漫游上；2：消息不同步至 From_Account
     * @param int    $msgLifeTime      消息离线保存时长（单位：秒），最长为7天（604800秒）若设置该字段为0，则消息只发在线用户，不保存离线若设置该字段超过7天（604800秒），仍只保存7天若不设置该字段，则默认保存7天
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function sendMessage($userId, array $messageBody, $fromUserId = '', $syncOtherMachine = \whereof\easyIm\Tencent\User\UserMessageClient::SYNC_OTHER_MACHINE_NO, $msgLifeTime = 604800)
    {
        $params = [
            'SyncOtherMachine' => $syncOtherMachine,
            'To_Account'       => $userId,
            'MsgLifeTime'      => $msgLifeTime,
            'MsgSeq'           => Timer::microTime(),
            'MsgRandom'        => Timer::microTime(),
            'MsgTimeStamp'     => time(),
            'MsgBody'          => $messageBody,
        ];
        if ($fromUserId) {
            $params['From_Account'] = $fromUserId;
        }

        return $this->send('openim/sendmsg', $params);
    }

    /**
     * 发送消息
     * https://cloud.tencent.com/document/product/269/1612.
     *
     * @param $userId
     * @param array  $messageBody
     * @param string $fromUserId       消息发送方 UserID（用于指定发送消息方帐号）
     * @param int    $syncOtherMachine 1：把消息同步到 From_Account 在线终端和漫游上；2：消息不同步至 From_Account
     * @param int    $msgLifeTime      消息离线保存时长（单位：秒），最长为7天（604800秒）若设置该字段为0，则消息只发在线用户，不保存离线若设置该字段超过7天（604800秒），仍只保存7天若不设置该字段，则默认保存7天
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function batchSendMessage(array $userId, array $messageBody, $fromUserId = '', $syncOtherMachine = UserMessageClient::SYNC_OTHER_MACHINE_NO, $msgLifeTime = 604800)
    {
        $params = [
            'SyncOtherMachine' => $syncOtherMachine,
            'To_Account'       => $userId,
            'MsgLifeTime'      => $msgLifeTime,
            'MsgSeq'           => Timer::microTime(),
            'MsgRandom'        => Timer::microTime(),
            'MsgTimeStamp'     => time(),
            'MsgBody'          => $messageBody,
        ];
        if ($fromUserId) {
            $params['From_Account'] = $fromUserId;
        }

        return $this->send('openim/sendmsg', $params);
    }

    /**
     * 导入单聊消息
     * https://cloud.tencent.com/document/product/269/2568.
     *
     * @param $userId
     * @param $fromUserId
     * @param array $messageBody
     * @param int   $syncOtherMachine
     * @param int   $msgLifeTime
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function importMessage($userId, $fromUserId, array $messageBody, $syncOtherMachine = UserMessageClient::SYNC_OTHER_MACHINE_NO, $msgLifeTime = 604800)
    {
        $params = [
            'SyncOtherMachine' => $syncOtherMachine,
            'From_Account'     => $fromUserId,
            'To_Account'       => $userId,
            'MsgLifeTime'      => $msgLifeTime,
            'MsgSeq'           => Timer::microTime(),
            'MsgRandom'        => Timer::microTime(),
            'MsgTimeStamp'     => time(),
            'MsgBody'          => $messageBody,
        ];

        return $this->send('openim/importmsg', $params);
    }

    /**
     * 撤回消息
     * https://cloud.tencent.com/document/product/269/38980.
     *
     * @param $messageId
     * @param string $userId
     * @param string $targetId
     *
     * @throws GuzzleException
     *
     * @return mixed|string
     */
    public function recallForMsgId($messageId, $userId, $targetId)
    {
        $params = [
            'From_Account' => (string) $userId,
            'To_Account'   => (string) $targetId,
            'MsgKey'       => $messageId,
        ];

        return $this->send('openim/admin_msgwithdraw', $params);
    }

    /**
     * 未读消息计数
     * https://cloud.tencent.com/document/product/269/56043.
     *
     * @param $userId
     * @param array $fromUserId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryUnreadNumber($userId, $fromUserId = [])
    {
        $params = [
            'To_Account' => $userId,
        ];
        if ($fromUserId) {
            $params['Peer_Account'] = $fromUserId;
        }

        return $this->send('openim/get_c2c_unread_msg_num', $params);
    }

    /**
     * 设置单聊消息已读
     * https://cloud.tencent.com/document/product/269/50349.
     *
     * @param string   $userId      进行消息已读的用户 UserId
     * @param int|null $msgReadTime 时间戳（秒），该时间戳之前的消息全部已读。若不填，则取当前时间戳
     * @param string   $targetId    进行消息已读的单聊会话的另一方用户 UserId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function read($userId, int $msgReadTime = null, $targetId = '')
    {
        $params = [
            'Report_Account' => (string) $userId,
            'MsgReadTime'    => $msgReadTime ?? time(),
        ];
        if ($targetId) {
            $params['Peer_Account'] = $targetId;
        }

        return $this->send('openim/admin_set_msg_read', $params);
    }
}
