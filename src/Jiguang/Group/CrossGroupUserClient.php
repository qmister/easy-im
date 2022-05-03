<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-24 12:28
 */

namespace whereof\easyIm\Jiguang\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class CrossGroupUserClient.
 *
 * @author zhiqiang
 */
class CrossGroupUserClient extends JiguangClient
{
    /**
     * @param $gid
     * @param $appKey
     * @param array $usernames
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function add($gid, $appKey, array $usernames)
    {
        $body = [[
            'appkey' => $appKey,
            'add'    => $usernames,
        ]];

        return $this->update($gid, $body);
    }

    /**
     * @param $gid
     * @param $appKey
     * @param array $usernames
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function remove($gid, $appKey, array $usernames)
    {
        $body = [[
            'appkey' => $appKey,
            'remove' => $usernames,
        ]];

        return $this->update($gid, $body);
    }

    /**
     * @param $gid
     * @param array $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function update($gid, array $params)
    {
        $response = $this->send('post', 'v1/cross/groups/'.$gid.'/members', $params);

        return $response;
    }

    /**
     * @param $gid
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function listAll($gid)
    {
        $response = $this->send('get', 'v1/cross/groups/'.$gid.'/members');

        return $response;
    }
}
