<?php
/*
 * Desc: 
 * User: zhiqiang
 * Date: 2021-10-31 18:11
 */

namespace whereof\easyIm\RongCloud\ChatRoom;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * Class MessagelevelClient
 * @author zhiqiang
 * @package whereof\easyIm\RongCloud\ChatRoom
 */
class MessagelevelClient extends RongCloudClient
{
    /**
     * 添加白名单用户
     * @param $chatroomId
     * @param $userId
     * @return string
     * @throws GuzzleException
     */
    public function userWhitelistAdd($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId
        ];
        return $this->send('chatroom/user/whitelist/add.json', $params);
    }

    /**
     * 移除白名单用户
     * @param $chatroomId
     * @param $userId
     * @return string
     * @throws GuzzleException
     */
    public function userWhitelistRemove($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId
        ];
        return $this->send('chatroom/user/whitelist/remove.json', $params);
    }

    /**
     * 查询白名单用户
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function userWhitelist($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/user/whitelist/query.json', $params);
    }

    /**
     * 添加低级别消息
     * @param $objectName
     * @return string
     * @throws GuzzleException
     */
    public function priorityAdd($objectName)
    {
        $params = [
            'objectName' => $objectName,
        ];
        return $this->send('chatroom/message/priority/add.json', $params);
    }

    /**
     * 移除低级别消息
     * @param $objectName
     * @return string
     * @throws GuzzleException
     */
    public function priorityRemove($objectName)
    {
        $params = [
            'objectName' => $objectName,
        ];
        return $this->send('chatroom/message/priority/remove.json', $params);
    }

    /**
     * 查询低级别消息
     * @param $objectName
     * @return string
     * @throws GuzzleException
     */
    public function priority($objectName)
    {
        $params = [
            'objectName' => $objectName,
        ];
        return $this->send('chatroom/message/priority/query.json', $params);
    }

    /**
     * 添加消息白名单
     * @param $objectName
     * @return string
     * @throws GuzzleException
     */
    public function whitelistAdd($objectName)
    {
        $params = [
            'objectName' => $objectName,
        ];
        return $this->send('chatroom/whitelist/add.json', $params);
    }

    /**
     * 移除消息白名单
     * @param $objectName
     * @return string
     * @throws GuzzleException
     */
    public function whitelistDelete($objectName)
    {
        $params = [
            'objectName' => $objectName,
        ];
        return $this->send('chatroom/whitelist/delete.json', $params);
    }

    /**
     * 查询消息白名单
     * @param $objectName
     * @return string
     * @throws GuzzleException
     */
    public function whitelist($objectName)
    {
        $params = [
            'objectName' => $objectName,
        ];
        return $this->send('chatroom/whitelist/query.json', $params);
    }
}