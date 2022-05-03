<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-24 02:02
 */

namespace whereof\easyIm\Jiguang\ChatRoom;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class ChatRoomClient.
 *
 * @author zhiqiang
 */
class ChatRoomClient extends JiguangClient
{
    /**
     * 获取应用下聊天室列表.
     *
     * @param $count
     * @param int $start
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryAppRoomList($count, $start = 0)
    {
        return $this->send('get', "v1/chatroom?start={$start}&count={$count}");
    }

    /**
     * 获取用户聊天室列表.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryUserRoom($userId)
    {
        return $this->send('get', "v1/users/{$userId}/chatroom");
    }

    /**
     * 获取聊天室成员列表.
     *
     * @param $roomId
     * @param $count
     * @param int $start
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryRoomUsers($roomId, $count, $start = 0)
    {
        $uri = 'v1/chatroom/'.$roomId.'/members';
        $params = [
            'start' => $start,
            'count' => $count,
        ];

        return $this->send('get', $uri, $params);
    }

    /**
     * @param $name
     * @param $owner
     * @param array $members
     * @param null  $description
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function create($name, $owner, array $members = [], $description = null)
    {
        $params = [
            'name'           => $name,
            'owner_username' => $owner,
        ];
        if (!empty($members)) {
            $params['members_username'] = $members;
        }
        if (!is_null($description)) {
            $params['description'] = $description;
        }
        $response = $this->send('post', 'v1/chatroom/', $params);

        return $response;
    }

    /**
     * @param $roomId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function info($roomId)
    {
        return $this->showInfo([$roomId]);
    }

    /**
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function showInfo($params)
    {
        return $this->send('post', 'v1/chatroom/'.'batch', $params);
    }

    /**
     * 更新聊天室信息.
     *
     * @param $roomId
     * @param string $owner
     * @param string $name
     * @param string $description
     *
     * @throws GuzzleException
     */
    public function update($roomId, $owner = '', $name = '', $description = '')
    {
        $params = [];
        if ($owner) {
            $params['owner_username'] = $owner;
        }
        if ($name) {
            $params['name'] = $name;
        }
        if ($description) {
            $params['description'] = $description;
        }
        $this->send('put', 'v1/chatroom/'.$roomId, $params);
    }

    /**
     * 删除聊天室.
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function delete()
    {
        return $this->send('delete', 'v1/chatroom/');
    }

    /**
     * 修改用户禁言状态
     *
     * @param $roomId
     * @param $userId
     * @param $enabled
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function forbiddenUser($roomId, $userId, $enabled)
    {
        $status = (bool) $enabled ? 1 : 0;

        return $this->send('put', 'v1/chatroom/'.$roomId.'/forbidden/'.$userId.'?status='.$status);
    }

    /**
     * 添加聊天室成员.
     *
     * @param $roomId
     * @param array $members
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function addMembers($roomId, array $members)
    {
        return $this->send('put', 'v1/chatroom/'.$roomId.'/members', $members);
    }

    /**
     * 移除聊天室成员.
     *
     * @param $roomId
     * @param array $members
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function removeMembers($roomId, array $members)
    {
        return $this->send('delete', 'v1/chatroom/'.$roomId.'/members', $members);
    }
}
