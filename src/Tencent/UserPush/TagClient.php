<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-21 22:15
 */

namespace whereof\easyIm\Tencent\UserPush;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Support\Arr;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class TagClient
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\UserPush
 */
class TagClient extends TencentClient
{
    /**
     * 获取用户标签
     * https://cloud.tencent.com/document/product/269/45940.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($userId)
    {
        $params = Arr::buildItem($userId, 'To_Account');

        return $this->send('all_member_push/im_get_tag', $params);
    }

    /**
     * 添加用户标签
     * https://cloud.tencent.com/document/product/269/45941.
     *
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialSet($params)
    {
        return $this->send('all_member_push/im_add_tag', $params);
    }

    /**
     * 删除用户标签
     * https://cloud.tencent.com/document/product/269/45942.
     *
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialDelete($params)
    {
        return $this->send('all_member_push/im_remove_tag', $params);
    }

    /**
     * 删除用户所有标签
     * https://cloud.tencent.com/document/product/269/45943.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function allDelete($userId)
    {
        $params = Arr::buildItem($userId, 'To_Account');

        return $this->send('all_member_push/im_remove_all_tags', $params);
    }
}
