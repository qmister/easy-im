<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-24 11:24
 */

namespace whereof\easyIm\Jiguang\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Support\Timer;

/**
 * 拉去聊天记录
 * Class HistoryClient.
 *
 * @author zhiqiang
 */
class HistoryClient extends JiguangClient
{
    /**
     * 第一次获取消息.
     *
     * @param int  $count
     * @param null $beginTime
     * @param null $endTime
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getMessage($count = 1000, $beginTime = null, $endTime = null)
    {
        list($s, $e) = Timer::beginEndTime($beginTime, $endTime, true);
        $params = [
            'count'      => $count,
            'begin_time' => $s,
            'end_time'   => $e,
        ];

        return $this->officialGetMessage($params);
    }

    /**
     * 第二次获取消息.
     *
     * @param $cursor
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getCursorMessage($cursor)
    {
        return $this->officialGetMessage([
            'cursor' => $cursor,
        ]);
    }

    /**
     * 获取发送消息.
     *
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialGetMessage($params)
    {
        return $this->send('GET', 'v2/messages', $params, true);
    }

    /**
     * 第一次获取用户发送消息.
     *
     * @param $useId
     * @param int  $count
     * @param null $beginTime
     * @param null $endTime
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getUserMessage($useId, $count = 500, $beginTime = null, $endTime = null)
    {
        list($s, $e) = Timer::beginEndTime($beginTime, $endTime, true);
        $params = [
            'count'      => $count,
            'begin_time' => $s,
            'end_time'   => $e,
        ];

        return $this->officialGetUserMessage($useId, $params);
    }

    /**
     * 第二次获取用户发送消息.
     *
     * @param $useId
     * @param $cursor
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getCursorUserMessage($useId, $cursor)
    {
        return $this->officialGetUserMessage($useId, [
            'cursor' => $cursor,
        ]);
    }

    /**
     * 获取用户发送消息.
     *
     * @param $useId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialGetUserMessage($useId, $params)
    {
        return $this->send('GET', "v2/users/{$useId}/messages", $params, true);
    }

    /**
     * 第一次获取群组消息.
     *
     * @param $useId
     * @param int  $count
     * @param null $beginTime
     * @param null $endTime
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getGroupMessage($useId, $count = 500, $beginTime = null, $endTime = null)
    {
        list($s, $e) = Timer::beginEndTime($beginTime, $endTime, true);
        $params = [
            'count'      => $count,
            'begin_time' => $s,
            'end_time'   => $e,
        ];

        return $this->officialGetGroupMessage($useId, $params);
    }

    /**
     * 第二次获取群组消息.
     *
     * @param $useId
     * @param $cursor
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getCursorGroupMessage($useId, $cursor)
    {
        return $this->officialGetGroupMessage($useId, [
            'cursor' => $cursor,
        ]);
    }

    /**
     * 获取群组消息.
     *
     * @param $groupId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialGetGroupMessage($groupId, $params)
    {
        return $this->send('GET', "v2/groups/{$groupId}/messages", $params, true);
    }

    /**
     * 第一次获取聊天室消息.
     *
     * @param $roomId
     * @param int  $count
     * @param null $beginTime
     * @param null $endTime
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getRoomMessage($roomId, $count = 500, $beginTime = null, $endTime = null)
    {
        list($s, $e) = Timer::beginEndTime($beginTime, $endTime, true);
        $params = [
            'count'      => $count,
            'begin_time' => $s,
            'end_time'   => $e,
        ];

        return $this->officialGetGroupMessage($roomId, $params);
    }

    /**
     * 第二次获取聊天室消息.
     *
     * @param $roomId
     * @param $cursor
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function getCursorRoomMessage($roomId, $cursor)
    {
        return $this->officialGetGroupMessage($roomId, [
            'cursor' => $cursor,
        ]);
    }

    /**
     * 获取获取聊天室消息.
     *
     * @param $roomId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialGetRoomMessage($roomId, $params)
    {
        return $this->send('GET', "v2/chatrooms/{$roomId}/messages", $params, true);
    }
}
