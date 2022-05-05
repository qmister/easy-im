<?php
/*
 * Desc: 
 * User: qmister
 * Date: 2021-10-31 14:57
 */

namespace whereof\easyIm\RongCloud\ChatRoom;

use GuzzleHttp\Exception\GuzzleException as GuzzleExceptionAlias;
use whereof\easyIm\RongCloud\Request\RongCloudClient;


/**
 * Class BlockClient
 * @author qmister
 * @package whereof\easyIm\RongCloud\Chatroom
 */
class BlockClient extends RongCloudClient
{
    /**
     * 获取封禁成员
     * @param $chatroomId
     * @return string
     * @throws GuzzleExceptionAlias
     */
    public function query($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/user/block/list.json', $params);
    }

    /**
     * 添加封禁成员
     * @param $chatroomId
     * @param $userId
     * @param $minute
     * @return string
     * @throws GuzzleExceptionAlias
     */
    public function add($chatroomId, $userId, $minute)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
            'minute'     => $minute,
        ];
        return $this->send('chatroom/user/block/add.json', $params);
    }

    /**
     * 移除封禁成员
     * @param $chatroomId
     * @param $userId
     * @return string
     * @throws GuzzleExceptionAlias
     */
    public function rollback($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
        ];
        return $this->send('chatroom/user/block/rollback.json', $params);
    }
}