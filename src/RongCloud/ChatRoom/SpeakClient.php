<?php
/*
 * Desc: 
 * User: zhiqiang
 * Date: 2021-10-31 14:47
 */

namespace whereof\easyIm\RongCloud\ChatRoom;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;


/**
 * Class SpeakClient
 * @author zhiqiang
 * @package whereof\easyIm\RongCloud\Chatroom
 */
class SpeakClient extends RongCloudClient
{
    /**
     * 单人禁言-获取禁言成员
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function queryGag($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/user/gag/list.json', $params);
    }

    /**
     * 单人禁言-添加禁言成员
     * @param $chatroomId
     * @param $userId
     * @param $minute
     * @return string
     * @throws GuzzleException
     */
    public function addGag($chatroomId, $userId, $minute)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
            'minute'     => $minute,
        ];
        return $this->send('chatroom/user/gag/add.json', $params);
    }

    /**
     * 单人禁言-移除禁言成员
     * @param $chatroomId
     * @param $userId
     * @return string
     * @throws GuzzleException
     */
    public function rollbackGag($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
        ];
        return $this->send('chatroom/user/gag/rollback.json', $params);
    }

    /**
     * 全体成员禁言-获取全体禁言列表
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function queryBen($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/ban/query.json', $params);
    }

    /**
     * 全体成员禁言-添加全体禁言
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function benAdd($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/ban/add.json', $params);
    }

    /**
     * 全体成员禁言-移除全体禁言
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function rollbackBen($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/ban/rollback.json', $params);
    }

    /**
     * 全体成员禁言-聊天室禁言状态检查
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function checkBen($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/ban/check.json', $params);
    }

    /**
     * 全体成员禁言白名单-获取禁言白名单
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function whitelistBen($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/user/ban/whitelist/query.json', $params);
    }

    /**
     * 全体成员禁言白名单-添加禁言白名单
     * @param $chatroomId
     * @param $userId
     * @return string
     * @throws GuzzleException
     */
    public function whitelistBenAdd($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
        ];
        return $this->send('chatroom/user/ban/whitelist/add.jsonn', $params);
    }

    /**
     * 全体成员禁言白名单-移除禁言白名单
     * @param $chatroomId
     * @param $userId
     * @return string
     * @throws GuzzleException
     */
    public function whitelistBenRollback($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
        ];
        return $this->send('chatroom/user/ban/whitelist/rollback.jsonn', $params);
    }

    /**
     * 全局禁言-获取禁言成员
     * @throws GuzzleException
     */
    public function queryUserBen()
    {
        return $this->send('chatroom/user/ban/query.json', []);
    }

    /**
     * 全局禁言-添加禁言成员
     * @param $userId
     * @param $minute
     * @return string
     * @throws GuzzleException
     */
    public function userBenAdd($userId, $minute)
    {
        $params = [
            'userId' => $userId,
            'minute' => $minute,
        ];
        return $this->send('chatroom/user/ban/add.json', $params);
    }

    /**
     * 全局禁言-移除禁言成员
     * @param $userId
     * @return string
     * @throws GuzzleException
     */
    public function userBenRemove($userId)
    {
        $params = [
            'userId' => $userId,
        ];
        return $this->send('chatroom/user/ban/remove.json', $params);
    }

    /**
     * 成员封禁-获取禁言成员
     * @param $chatroomId
     * @return string
     * @throws GuzzleException
     */
    public function queryUserBlock($chatroomId)
    {
        $params = [
            'chatroomId' => $chatroomId,
        ];
        return $this->send('chatroom/user/block/list.json', $params);
    }

    /**
     * 成员封禁-添加封禁成员
     * @param $chatroomId
     * @param $userId
     * @param $minute
     * @return string
     * @throws GuzzleException
     */
    public function userBlockAdd($chatroomId, $userId, $minute)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
            'minute'     => $minute,
        ];
        return $this->send('chatroom/user/block/add.json', $params);
    }

    /**
     * 成员封禁-移除封禁成员
     * @param $chatroomId
     * @param $userId
     * @return string
     * @throws GuzzleException
     */
    public function userBlockRollback($chatroomId, $userId)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
        ];
        return $this->send('chatroom/user/block/rollback.json', $params);
    }


}