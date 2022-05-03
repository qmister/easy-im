<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-24 12:21
 */

namespace whereof\easyIm\Jiguang\Message;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class CrossMessageClient.
 *
 * @author zhiqiang
 */
class CrossMessageClient extends MessageClient
{
    /**
     * @param $version
     * @param array $appKey
     * @param array $from
     * @param array $target
     * @param array $msg
     * @param array $notification
     * @param array $options
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function sendText($version, $appKey, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $opts = array_merge($options, ['target_appkey' => $appKey]);

        return parent::sendText($version, $from, $target, $msg, $notification, $opts);
    }

    /**
     * @param $version
     * @param array $appKey
     * @param array $from
     * @param array $target
     * @param array $msg
     * @param array $notification
     * @param array $options
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function sendImage($version, $appKey, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $opts = array_merge($options, ['target_appkey' => $appKey]);

        return parent::sendImage($version, $from, $target, $msg, $notification, $opts);
    }

    /**
     * @param $version
     * @param array $appKey
     * @param array $from
     * @param array $target
     * @param array $msg
     * @param array $notification
     * @param array $options
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function sendVoice($version, $appKey, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $opts = array_merge($options, ['target_appkey' => $appKey]);

        return parent::sendVoice($version, $from, $target, $msg, $notification, $opts);
    }

    /**
     * @param $version
     * @param array $appKey
     * @param array $from
     * @param array $target
     * @param array $msg
     * @param array $notification
     * @param array $options
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function sendCustom($version, $appKey, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $opts = array_merge($options, ['target_appkey' => $appKey]);

        return parent::sendCustom($version, $from, $target, $msg, $notification, $opts);
    }
}
