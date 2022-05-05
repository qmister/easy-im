<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 23:59
 */

namespace whereof\easyIm\Yunxin\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserInterface;
use whereof\easyIm\Yunxin\Request\YunxinClient;

/**
 * Class UserClinet.
 *
 * @author qmister
 */
class UserClinet extends YunxinClient implements UserInterface
{
    /**
     * @param $userId
     * @param null $name
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function create($userId, $name = null)
    {
        $params = [
            'accid' => $userId,
            'name'  => $name ?? uniqid('easyIm_'),
        ];

        return $this->send('nimserver/user/create.action', $params);
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
        $params = [
            'accids' => $userId,
        ];

        return $this->send('nimserver/user/getUinfos.action', $params);
    }

    public function delete($userId)
    {
        // TODO: Implement delete() method.
    }

    public function status($userId)
    {
        // TODO: Implement status() method.
    }

    public function expire($userId)
    {
        // TODO: Implement expire() method.
    }

    /**
     * 重置网易云信IM token.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function refreshToken($userId)
    {
        return $this->send('nimserver/user/update.action', [
            'accid' => $userId,
        ]);
    }

    /**
     * 封禁网易云信IM账号.
     *
     * @param $userId
     * @param bool $needKick
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function block($userId, bool $needKick = true)
    {
        $params = [
            'accid'    => $userId,
            'needkick' => $needKick,
        ];

        return $this->send('nimserver/user/block.action', $params);
    }

    /**
     * 解禁网易云信IM账号.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function unBlock($userId)
    {
        $params = [
            'accid' => $userId,
        ];

        return $this->send('nimserver/user/block.action', $params);
    }
}
