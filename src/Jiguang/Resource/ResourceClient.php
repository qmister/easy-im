<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-24 02:35
 */

namespace whereof\easyIm\Jiguang\Resource;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * 媒体文件下载与上传
 * Class ResourceClient.
 *
 * @author qmister
 */
class ResourceClient extends JiguangClient
{
    /**
     * 文件下载.
     *
     * @param $mediaId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function download($mediaId)
    {
        $query = ['mediaId' => $mediaId];

        return $this->send('get', 'v1/resource', $query);
    }

    /**
     * 文件上传.
     *
     * @param $type
     * @param $file
     *
     * @throws GuzzleException
     *
     * @return bool|string
     */
    public function upload($type, $file)
    {
        return $this->send('upload', "v1/resource?type={$type}", [
            'file' => $file,
        ]);
    }
}
