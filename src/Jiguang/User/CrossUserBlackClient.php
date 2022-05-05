<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-24 12:34
 */

namespace whereof\easyIm\Jiguang\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class CrossUserBlackClient.
 *
 * @author qmister
 */
class CrossUserBlackClient extends JiguangClient
{
    /**
     * @param $user
     * @param $appKey
     * @param array $usernames
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function add($user, $appKey, array $usernames)
    {
        $body = [[
            'appkey'    => $appKey,
            'usernames' => $usernames,
        ]];

        return $this->batchAdd($user, $body);
    }

    /**
     * @param $user
     * @param array $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchAdd($user, array $params)
    {
        return $this->send('put', "v1/cross/users/{$user}/blacklist", $params);
    }

    /**
     * @param $user
     * @param $appKey
     * @param array $usernames
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function remove($user, $appKey, array $usernames)
    {
        $body = [[
            'appkey'    => $appKey,
            'usernames' => $usernames,
        ]];

        return $this->batchRemove($user, $body);
    }

    /**
     * @param $user
     * @param array $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchRemove($user, array $params)
    {
        return $this->send('delete', "v1/cross/users/{$user}/blacklist", $params);
    }

    /**
     * @param $user
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function listAll($user)
    {
        return $this->send('get', "v1/cross/users/{$user}/blacklist");
    }
}
