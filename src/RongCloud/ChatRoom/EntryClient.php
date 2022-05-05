<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-27 22:51
 */

namespace whereof\easyIm\RongCloud\ChatRoom;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\RongCloud\Request\RongCloudClient;


/**
 * https://doc.rongcloud.cn/imserver/server/v1/chatroom/kv
 * Class EntryClient
 * @author qmister
 * @package whereof\easyIm\RongCloud\Chatroom
 */
class EntryClient extends RongCloudClient
{
    /**
     * 获取属性.
     *
     * @param $chatroomId
     * @param $key
     *
     * @return string
     * @throws GuzzleException
     */
    public function query($chatroomId, $key)
    {
        $params = [
            'chatroomId' => $chatroomId,
            'key'        => $key,
        ];
        return $this->send('chatroom/entry/query.json', $params);
    }

    /**
     * 设置属性.
     *
     * @param $chatroomId
     * @param $userId
     * @param $key
     * @param $value
     * @param int $autoDelete
     * @param string $objectName
     * @param string $content
     *
     * @return string
     * @throws GuzzleException
     */
    public function set($chatroomId, $userId, $key, $value, $autoDelete = 0, $objectName = '', $content = '')
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
            'key'        => $key,
            'value'      => $value,
            'autoDelete' => $autoDelete,
        ];
        if ($objectName) {
            $params['objectName'] = $objectName;
        }
        if ($content) {
            $params['content'] = $content;
        }
        return $this->send('chatroom/entry/set.json', $params);
    }

    /**
     * 删除属性.
     *
     * @param $chatroomId
     * @param $userId
     * @param $key
     * @param int $autoDelete
     * @param string $objectName
     * @param string $content
     *
     * @return string
     * @throws GuzzleException
     */
    public function remove($chatroomId, $userId, $key, $autoDelete = 0, $objectName = '', $content = '')
    {
        $params = [
            'chatroomId' => $chatroomId,
            'userId'     => $userId,
            'key'        => $key,
            'autoDelete' => $autoDelete,
        ];
        if ($objectName) {
            $params['objectName'] = $objectName;
        }
        if ($content) {
            $params['content'] = $content;
        }
        return $this->send('chatroom/entry/remove.json', $params);
    }
}
