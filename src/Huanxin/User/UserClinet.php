<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 23:12
 */

namespace whereof\easyIm\Huanxin\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Huanxin\Request\HuanxinClient;
use whereof\easyIm\Kernel\Interfaces\UserInterface;
use whereof\easyIm\Kernel\Support\Arr;

/**
 * Class UserClinet.
 *
 * @author qmister
 */
class UserClinet extends HuanxinClient implements UserInterface
{
    /**
     * 导入用户信息.
     *
     * @param $userId
     * @param null $password
     * @param null $nickname
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function create($userId, $password = null, $nickname = null)
    {
        $params = [
            'username' => $userId,
            'password' => $password ?? '123456',
            'nickname' => $nickname ?? uniqid('easyIm_'),
        ];

        return $this->send('post', 'users', $params);
    }

    /**
     * @param array $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchCreate(array $userId)
    {
        $params = Arr::buildItem($userId, 'username', [
            'password' => '123456',
        ]);

        return $this->send('post', 'users', $params);
    }

    /**
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function info($userId)
    {
        return $this->send('get', "users/{$userId}");
    }

    /**
     * @param $limit
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchInfoForLimit($limit)
    {
        return $this->send('get', 'users', [
            'limit' => $limit,
        ]);
    }

    /**
     * 删除用户信息.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function delete($userId)
    {
        return $this->send('delete', "users/{$userId}");
    }

    /**
     * 批量删除.
     *
     * @param $limit
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchDeleteForLimit($limit)
    {
        return $this->send('delete', 'users', [
            'limit' => $limit,
        ]);
    }

    /**
     * 用户状态
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function status($userId)
    {
        return $this->send('get', "users/{$userId}/status");
    }

    /**
     * 用户失效.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function expire($userId)
    {
        return $this->send('get', "users/{$userId}/disconnect");
    }
}
