<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-25 21:59
 */

namespace whereof\easyIm\RongCloud\SensitiveWord;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\SensitiveWordInterface;
use whereof\easyIm\RongCloud\Request\RongCloudClient;

/**
 * Class SensitiveWordClient.
 *
 * @author qmister
 */
class SensitiveWordClient extends RongCloudClient implements SensitiveWordInterface
{
    /**
     * 获取敏感词列表.
     *
     * @param int $type 查询敏感词的类型，0 为查询替换敏感词，1 为查询屏蔽敏感词，2 为查询全部敏感词。默认为 1。
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function listAll($type = 1)
    {
        $params = [
            'type' => $type,
        ];

        return $this->send('sensitiveword/list.json', $params);
    }

    /**
     * 添加敏感词.
     *
     * @param $word
     * @param string $replaceWord 替换后的词，最长不超过 32 个字符。如未设置，当消息中含有敏感词时，消息将被屏蔽，用户不会收到消息。如设置了，当消息中含有敏感词时，将被替换为指定的词进行发送。
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function add($word, $replaceWord = '')
    {
        $params = [
            'word' => $word,
        ];
        if ($replaceWord) {
            $params['replaceWord'] = $replaceWord;
        }

        return $this->send('sensitiveword/add.json', $params);
    }

    /**
     * 移除敏感词.
     *
     * @param $word
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete($word)
    {
        $params = [
            'word' => $word,
        ];

        return $this->send('sensitiveword/delete.json', $params);
    }

    /**
     * 移除敏感词.
     *
     * @param $word
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function batchDelete($word)
    {
        $params = [
            'word' => $word,
        ];

        return $this->send('sensitiveword/batch/delete.json', $params);
    }
}
