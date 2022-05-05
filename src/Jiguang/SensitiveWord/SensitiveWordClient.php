<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-24 02:28
 */

namespace whereof\easyIm\Jiguang\SensitiveWord;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\Kernel\Interfaces\SensitiveWordInterface;

/**
 * Class SensitiveWordClient.
 *
 * @author qmister
 */
class SensitiveWordClient extends JiguangClient implements SensitiveWordInterface
{
    /**
     * 获取敏感词列表.
     *
     * @param $count
     * @param int $start
     *
     * @return string
     * @throws GuzzleException
     *
     */
    public function listAll($count = 2000, $start = 0)
    {
        $query = [
            'start' => $start,
            'count' => $count,
        ];

        return $this->send('get', 'v1/sensitiveword', $query);
    }

    /**
     * 添加敏感词.
     *
     * @param array $words
     *
     * @return string
     * @throws GuzzleException
     *
     */
    public function add($words)
    {
        return $this->send('post', 'v1/sensitiveword', $words);
    }

    /**
     * 删除敏感词.
     *
     * @param $word
     *
     * @return string
     * @throws GuzzleException
     *
     */
    public function delete($word)
    {
        $body = ['word' => $word];

        return $this->send('delete', 'v1/sensitiveword', $body);
    }

    /**
     * 修改敏感词.
     *
     * @param $old
     * @param $new
     *
     * @return string
     * @throws GuzzleException
     *
     */
    public function update($old, $new)
    {
        $body = [
            'old_word' => $old,
            'new_word' => $new,
        ];

        return $this->send('put', 'v1/sensitiveword', $body);
    }

    /**
     * 获取敏感词功能状态
     *
     * @return string
     * @throws GuzzleException
     *
     */
    public function getStatus()
    {
        return $this->send('get', 'v1/sensitiveword/status');
    }

    /**
     * 更新敏感词功能状态
     *
     * @param $opened
     *
     * @return string
     * @throws GuzzleException
     *
     */
    public function updateStatus($opened)
    {
        return $this->send('put', 'v1/sensitiveword/status?status=' . (int)$opened);
    }
}
