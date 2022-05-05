<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-23 00:19
 */

namespace whereof\easyIm\Jiguang\Admin;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class AdminClient.
 *
 * @author qmister
 */
class AdminClient extends JiguangClient
{
    /**
     * @param $count
     * @param int $start
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($count, $start = 0)
    {
        $params = [
            'start' => $start,
            'count' => $count,
        ];

        return $this->send('get', 'v1/admins/', $params);
    }

    /**
     * @param $admin
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function register($admin)
    {
        $params = (array) $admin;

        return $this->send('post', 'v1/admins/', $params);
    }
}
