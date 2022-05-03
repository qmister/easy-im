<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-18 23:11
 */

namespace whereof\easyIm\Tencent\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\GroupMessageInterface;
use whereof\easyIm\Kernel\Support\Arr;
use whereof\easyIm\Kernel\Support\Timer;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class MessageClient
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\Group
 */
class MessageClient extends TencentClient implements GroupMessageInterface
{
    /**
     * 拉群消息
     * https://cloud.tencent.com/document/product/269/2738.
     *
     * @param $groupId
     * @param int $reqMsgNumber 拉取的历史消息的条数，目前一次请求最多返回20条历史消息，所以这里最好小于等于20
     * @param int $reqMsgSeq    拉取消息的最大 seq
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function queryMessage($groupId, $reqMsgNumber = 20, $reqMsgSeq = 0)
    {
        $params = [
            'GroupId'      => $groupId,
            'ReqMsgNumber' => $reqMsgNumber,
        ];
        if ($reqMsgSeq > 0) {
            $params['ReqMsgSeq'] = $reqMsgSeq;
        }

        return $this->send('group_open_http_svc/group_msg_get_simple', $params);
    }

    /**
     * 发送群消息
     * https://cloud.tencent.com/document/product/269/1629.
     *
     * @param $groupId
     * @param array  $messageBody    https://cloud.tencent.com/document/product/269/2720
     * @param string $from_account   指定消息发送者
     * @param array  $sendMsgControl 消息发送权限，NoLastMsg 只对单条消息有效，表示不更新最近联系人会话；NoUnread 不计未读，只对单条消息有效。（如果该消息 OnlineOnlyFlag 设置为1，则不允许使用该字段。）
     * @param array  $at             发送群@消息
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function sendMessage($groupId, array $messageBody, $from_account = '', array $sendMsgControl = [], $at = null)
    {
        $params = [
            'GroupId' => $groupId,
            'Random'  => Timer::microTime(),
            'MsgBody' => $messageBody,
        ];
        if ($from_account) {
            $params['From_Account'] = $from_account;
        }
        if ($sendMsgControl) {
            $params['SendMsgControl'] = $sendMsgControl;
        }
        if (!is_null($at)) {
            //@所有人
            if ($at === 'all') {
                $params['GroupAtInfo'] = ['GroupAtAllFlag' => 1];
            }
            //@ 成员
            $params['GroupAtInfo'] = Arr::buildItem($at, 'GroupAt_Account', [
                'GroupAtAllFlag' => 0,
            ]);
        }

        return $this->send('group_open_http_svc/send_group_msg', $params);
    }

    /**
     * 导入群消息
     * https://cloud.tencent.com/document/product/269/1635.
     *
     * @param $groupId
     * @param array $msgList           导入的消息列表
     * @param int   $recentContactFlag 会话更新识别，为1的时候标识触发会话更新，默认不触发（avchatroom 群不支持）。
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchSendMessage($groupId, array $msgList, $recentContactFlag = 0)
    {
        $params = [
            'GroupId'           => $groupId,
            'RecentContactFlag' => $recentContactFlag,
            'MsgBody'           => $msgList,
        ];

        return $this->send('group_open_http_svc/import_group_msg', $params);
    }

    /**
     * 撤回群消息
     * https://cloud.tencent.com/document/product/269/12341.
     *
     * @param $groupId
     * @param $messageId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function recallForMsgId($groupId, $messageId)
    {
        $params = [
            'GroupId'    => (string) $groupId,
            'MsgSeqList' => Arr::buildItem($messageId, 'MsgSeq'),
        ];

        return $this->send('group_open_http_svc/group_msg_recall', $params);
    }

    /**
     * 撤回指定用户发送的消息
     * https://cloud.tencent.com/document/product/269/2359.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function recallForUserId($groupId, $userId)
    {
        $params = [
            'GroupId'        => (string) $groupId,
            'Sender_Account' => $userId,
        ];

        return $this->send('group_open_http_svc/group_msg_recall', $params);
    }
}
