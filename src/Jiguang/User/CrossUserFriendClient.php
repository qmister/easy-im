<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-24 12:30
 */

namespace whereof\easyIm\Jiguang\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class CrossUserFriendClient.
 *
 * @author qmister
 */
class CrossUserFriendClient extends JiguangClient
{
    /**
     * @param $user
     * @param $appKey
     * @param array $friendnames
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function add($user, $appKey, array $friendnames)
    {
        $params = [
            'appkey' => $appKey,
            'users'  => $friendnames,
        ];

        return $this->send('post', "v1/cross/users/{$user}/friends", $params);
    }

    /**
     * @param $user
     * @param $appKey
     * @param array $friendnames
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function remove($user, $appKey, array $friendnames)
    {
        $params = [
            'appkey' => $appKey,
            'users'  => $friendnames,
        ];

        return $this->send('delete', "v1/cross/users/{$user}/friends", $params);
    }

    /**
     * @param $user
     * @param $appKey
     * @param $friendname
     * @param array $options
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function updateNotename($user, $appKey, $friendname, array $options)
    {
        $body = [
            'appkey'   => $appKey,
            'username' => $friendname,
        ];

        if (isset($options['note_name'])) {
            $body['note_name'] = $options['note_name'];
        }

        if (isset($options['others'])) {
            $body['others'] = $options['others'];
        }

        return $this->batchUpdateNotename($user, [$body]);
    }

    /**
     * @param $user
     * @param array $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchUpdateNotename($user, array $params)
    {
        return $this->send('put', "v1/cross/users/{$user}/friends", $params);
    }
}
