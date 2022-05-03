<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-17 23:31
 */

namespace whereof\easyIm\Jiguang\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Interfaces\UserInterface;
use whereof\easyIm\Kernel\Support\Arr;

/**
 * Class UserClinet.
 *
 * @author zhiqiang
 */
class UserClinet extends JiguangClient implements UserInterface
{
    /**
     * 注册用户.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function create($userId)
    {
        return $this->batchCreate($userId);
    }

    /**
     * 注册用户.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchCreate($userId)
    {
        $params = Arr::buildItem($userId, 'username', [
            'password' => '123456',
        ]);

        return $this->send('post', 'v1/users/', $params);
    }

    /**
     * 更新用户信息.
     *
     * @param $userId
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function update($userId, $params)
    {
        return $this->send('PUT', 'v1/users/'."{$userId}", $params);
    }

    /**
     * 修改密码
     *
     * @param $userId
     * @param $newPwd
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function updatePwd($userId, $newPwd)
    {
        $params = [
            'new_password' => $newPwd,
        ];

        return $this->send('PUT', 'v1/users/'."{$userId}/password", $params);
    }

    /**
     * 获取用户信息.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function info($userId)
    {
        return $this->send('get', 'v1/users/'."{$userId}");
    }

    /**
     * 删除用户.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function delete($userId)
    {
        return $this->send('DELETE', 'v1/users/'."{$userId}");
    }

    /**
     * 批量删除用户.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchDelete(array $userId)
    {
        return $this->send('DELETE', 'v1/users/', $userId);
    }

    /**
     * 用户在线状态查询v1.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function status($userId)
    {
        return $this->send('get', 'v1/users/'.$userId.'userstat');
    }

    /**
     * 批量用户在线状态查询.
     *
     * @param array  $userId
     * @param string $version
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchStatus(array $userId)
    {
        return $this->send('post', 'v1/users/userstat', $userId);
    }

    /**
     * @param $userId
     */
    public function expire($userId)
    {
        // TODO: Implement expire() method.
    }
}
