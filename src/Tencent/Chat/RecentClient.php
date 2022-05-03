<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-21 22:47
 */

namespace whereof\easyIm\Tencent\Chat;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Tencent\Request\TencentClient;

/**
 * Class RecentClient.
 * @author zhiqiang
 */
class RecentClient extends TencentClient
{
    /**
     * 拉取会话列表
     * https://cloud.tencent.com/document/product/269/62118.
     *
     * @param $usrId
     * @param int $timeStamp     普通会话的起始时间，第一页填 0
     * @param int $startIndex    普通会话的起始位置，第一页填 0
     * @param int $topTimeStamp  置顶会话的起始时间，第一页填 0
     * @param int $topStartIndex 置顶会话的起始位置，第一页填 0
     * @param int $assistFlags   会话辅助标志位:bit 0 - 是否支持置顶会话 bit 1 - 是否返回空会话 bit 2 - 是否支持置顶会话分页
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($usrId, $timeStamp = 0, $startIndex = 0, $topTimeStamp = 0, $topStartIndex = 0, $assistFlags = 0)
    {
        $params = [
            'From_Account'  => $usrId,
            'TimeStamp'     => $timeStamp,
            'StartIndex'    => $startIndex,
            'TopTimeStamp'  => $topTimeStamp,
            'TopStartIndex' => $topStartIndex,
            'AssistFlags'   => $assistFlags,
        ];

        return $this->send('recentcontact/get_list', $params);
    }

    /**
     * 删除单个会话
     * https://cloud.tencent.com/document/product/269/62119.
     *
     * @param $usrId
     * @param $toUserId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function delete($usrId, $toUserId)
    {
        $params = [
            'From_Account' => $usrId,
            'To_Account'   => $toUserId,
        ];

        return $this->send('recentcontact/get_list', $params);
    }
}
