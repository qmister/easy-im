<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-19 22:36
 */

namespace whereof\easyIm\Tencent\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserFriendInterface;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class BlackFriendClient
 * @author qmister
 * @package whereof\easyIm\Tencent\User
 */
class BlackFriendClient extends TencentClient implements UserFriendInterface
{
    /**
     * 拉去黑名单
     * https://cloud.tencent.com/document/product/269/3722.
     *
     * @param $userId
     * @param int $startIndex   拉取的起始位置
     * @param int $maxLimited   每页最多拉取的黑名单数
     * @param int $lastSequence 上一次拉黑名单时后台返回给客户端的 Seq，初次拉取时为0
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($userId, $startIndex = 0, $maxLimited = 30, $lastSequence = 0)
    {
        $params = [
            'From_Account' => $userId,
            'StartIndex'   => $startIndex,
            'MaxLimited'   => $startIndex,
            'LastSequence' => $lastSequence,
        ];

        return $this->send('sns/black_list_get', $params);
    }

    /**
     * 建立关系.
     *
     * @param $userId
     * @param $toUserId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addTo($userId, $toUserId)
    {
        $params = [
            'From_Account' => (string) $userId,
            'To_Account'   => (array) $toUserId,
        ];

        return $this->send('sns/black_list_add', $params);
    }

    //单向校验好友关系
    const BOTH = 'BlackCheckResult_Type_Both';
    //双向校验好友关系
    const SINGLE = 'CheckResult_Type_Single';

    /**
     * 校验黑名单
     * https://cloud.tencent.com/document/product/269/3725.
     *
     * @param $useId
     * @param $toUserId
     * @param string $checkType 单向校验好友关系 CheckResult_Type_Single 双向校验好友关系 CheckResult_Type_Both
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function check($useId, $toUserId, $checkType = BlackFriendClient::BOTH)
    {
        $params = [
            'From_Account' => $useId,
            'To_Account'   => $toUserId,
            'CheckType'    => $checkType,
        ];

        return $this->send('sns/black_list_check', $params);
    }

    /**
     * 移除关系.
     *
     * @param $useId
     * @param $toUserId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function remove($useId, $toUserId)
    {
        $params = [
            'From_Account' => $useId,
            'To_Account'   => (array) $toUserId,
        ];

        return $this->send('sns/black_list_delete', $params);
    }
}
