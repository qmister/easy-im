<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-24 03:32
 */

namespace whereof\easyIm\Jiguang\Message;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class MessageClient.
 *
 * @author zhiqiang
 */
class MessageClient extends JiguangClient
{
    /**
     * @param $version
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
    public function sendText($version, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $params = array_merge([
            'msg_type' => 'text',
            'msg_body' => [
                'text' => $msg['text'],
            ],
        ], $this->buildMessageBody($version, $from, $target, $notification, $options));

        if (isset($msg['extras']) && is_array($msg['extras'])) {
            $params['msg_body']['extras'] = $msg['extras'];
        }

        return $this->officialSendMessage($params);
    }

    /**
     * @param $version
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
    public function sendImage($version, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $params = array_merge([
            'msg_type' => 'image',
            'msg_body' => [
                'media_id'    => $msg['media_id'],
                'media_crc32' => $msg['media_crc32'],
                'width'       => $msg['width'],
                'height'      => $msg['height'],
                'format'      => $msg['format'],
                'fsize'       => $msg['fsize'],
            ],
        ], $this->buildMessageBody($version, $from, $target, $notification, $options));

        if (isset($msg['hash'])) {
            $params['msg_body']['hash'] = $msg['hash'];
        }

        return $this->officialSendMessage($params);
    }

    /**
     * @param $version
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
    public function sendVoice($version, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $params = array_merge([
            'msg_type' => 'voice',
            'msg_body' => [
                'media_id'    => $msg['media_id'],
                'media_crc32' => $msg['media_crc32'],
                'duration'    => $msg['duration'],
                'hash'        => $msg['hash'],
                'fsize'       => $msg['fsize'],
            ],
        ], $this->buildMessageBody($version, $from, $target, $notification, $options));

        if (isset($msg['hash'])) {
            $params['msg_body']['hash'] = $msg['hash'];
        }

        return $this->officialSendMessage($params);
    }

    /**
     * @param $version
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
    public function sendCustom($version, array $from, array $target, array $msg, array $notification = [], array $options = [])
    {
        $params = array_merge([
            'msg_type' => 'custom',
            'msg_body' => $msg,
        ], $this->buildMessageBody($version, $from, $target, $notification, $options));

        return $this->officialSendMessage($params);
    }

    /**
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialSendMessage($params)
    {
        return $this->send('POST', 'v1/messages', $params);
    }

    /**
     * 撤回消息.
     *
     * @param string $messageId 消息msgid
     * @param string $userId    发送此msg的用户名
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function recallForMsgId($messageId, $userId)
    {
        return $this->send('POST', "v1/messages/{$userId}/{$messageId}/retract");
    }

    /**
     * @param $version
     * @param array $from
     * @param array $target
     * @param array $notification
     * @param array $options
     *
     * @return array
     */
    private function buildMessageBody($version, array $from, array $target, array $notification = [], array $options = [])
    {
        $opts = [
            'version'     => $version,
            'target_type' => $target['type'],
            'from_type'   => $from['type'],
            'target_id'   => $target['id'],
            'from_id'     => $from['id'],
        ];
        if (isset($from['name'])) {
            $opts['from_name'] = $from['name'];
        }
        if (isset($target['name'])) {
            $opts['target_name'] = $target['name'];
        }
        if (isset($options['offline'])) {
            $opts['no_offline'] = !$options['offline'];
        }

        if (isset($options['target_appkey'])) {
            $opts['target_appkey'] = $options['target_appkey'];
        }

        if (isset($notification['notifiable'])) {
            $opts['no_notification'] = !$notification['notifiable'];
        }
        if (isset($notification['title'])) {
            $opts['notification']['title'] = $notification['title'];
        }
        if (isset($notification['alert'])) {
            $opts['notification']['alert'] = $notification['alert'];
        }

        return $opts;
    }
}
