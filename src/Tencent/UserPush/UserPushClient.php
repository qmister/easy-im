<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-21 21:52
 */

namespace whereof\easyIm\Tencent\UserPush;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Support\Timer;
use whereof\easyIm\Tencent\Request\TencentClient;

/**
 * Class UserPushClient
 * @author qmister
 * @package whereof\easyIm\Tencent\UserPush
 */
class UserPushClient extends TencentClient
{
    /**
     * 全员推送
     * https://cloud.tencent.com/document/product/269/45934.
     *
     * @param string $userId      消息推送方帐号
     * @param array  $messageBody 消息内容，https://cloud.tencent.com/document/product/269/2720
     * @param array  $condition   Condition 共有4种条件类型，分别是：属性的或条件 AttrsOr 属性的与条件 AttrsAnd 标签的或条件 TagsOr 标签的与条件 TagsAnd
     * @param int    $msgLifeTime
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function push($userId, array $messageBody, array $condition, $msgLifeTime = 604800)
    {
        $params = [
            'From_Account' => $userId,
            'MsgRandom'    => Timer::microTime(),
            'MsgLifeTime'  => $msgLifeTime,
            'MsgBody'      => $messageBody,
        ];
        if ($condition) {
            $params['Condition'] = $condition;
        }

        return $this->send('all_member_push/im_push', $params);
    }
}
