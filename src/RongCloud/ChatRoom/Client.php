<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-27 22:44
 */

namespace whereof\easyIm\RongCloud\ChatRoom;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * Class Client
 * @author zhiqiang
 * @package whereof\easyIm\RongCloud\Chatroom
 */
class Client extends RongCloudClient
{
    /**
     * 创建房间
     * https://doc.rongcloud.cn/imserver/server/v1/chatroom/create
     * chatroom[10001]=name1&chatroom[10002]=name2&chatroom[10003]=name3.
     *
     * @param array $chatroomIdName
     *
     * @return string
     * @throws GuzzleException
     */
    public function create(array $chatroomIdName)
    {
        return $this->send('chatroom/create.json', $chatroomIdName);
    }

    /**
     * 查询房间信息
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function info($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/query.json', $params);
    }

    /**
     * 获取聊天室成员
     * @param $chatroomId
     * @param int $count
     * @param int $order
     * @return string
     * @throws GuzzleException
     */
    public function queryUser($chatroomId, $count = 500, $order = 2)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'count'      => $count,
            'order'      => $order,
        ];
        return $this->send('chatroom/user/query.json', $params);
    }

    /**
     * 查询用户是否加入
     * @param $chatroomId
     * @param int $userId
     * @return string
     * @throws GuzzleException
     */
    public function queryUserExist($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
        ];
        return $this->send('chatroom/user/exist.json', $params);
    }


    /**
     * 查询保活聊天室
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function queryKeepalive($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/keepalive/query.json', $params);
    }

    /**
     * 添加保活聊天室
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function keepaliveAdd($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/keepalive/add.json', $params);
    }

    /**
     * 添加保活聊天室
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function keepaliveRemove($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/keepalive/remove.json', $params);
    }

    /**
     * 销毁房间
     * https://doc.rongcloud.cn/imserver/server/v1/chatroom/destroy
     * chatroomId=10001&chatroomId=10002.
     *
     * @param $chatroomId
     *
     * @return string
     * @throws GuzzleException
     */
    public function destroy($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/destroy.json', $params);
    }

}
