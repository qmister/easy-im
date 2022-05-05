<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-21 22:00
 */

namespace whereof\easyIm\Tencent\UserPush;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Support\Arr;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class AttrNamesClient
 * @author qmister
 * @package whereof\easyIm\Tencent\UserPush
 */
class AttrNamesClient extends TencentClient
{
    /**
     * 获取应用属性名称
     * https://cloud.tencent.com/document/product/269/45936.
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryApp()
    {
        return $this->send('all_member_push/im_get_attr_name', []);
    }

    /**
     * 设置应用属性名称
     * https://cloud.tencent.com/document/product/269/45935.
     *
     * @param array $attrName
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function setApp(array $attrName)
    {
        return $this->send('all_member_push/im_set_attr_name', [
            'AttrNames' => $attrName,
        ]);
    }

    /**
     * 获取用户属性
     * https://cloud.tencent.com/document/product/269/45937.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryUser($userId)
    {
        $params = [
            'To_Account' => (array) $userId,
        ];

        return $this->send('all_member_push/im_get_attr', $params);
    }

    /**
     * 给某些用户设置同样的属性.
     *
     * @param $userId
     * @param $attrs
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function setUser($userId, $attrs)
    {
        $params = Arr::buildItem($userId, 'To_Account', [
            'Attrs' => $attrs,
        ]);

        return $this->officialSetUser($params);
    }

    /**
     * 设置用户属性
     * https://cloud.tencent.com/document/product/269/45938.
     *
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialSetUser($params)
    {
        return $this->send('all_member_push/im_set_attr', $params);
    }

    /**
     * 给某些用户删除同样的属性.
     *
     * @param $userId
     * @param $attrs
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function deleteUser($userId, $attrs)
    {
        $params = Arr::buildItem($userId, 'To_Account', [
            'Attrs' => $attrs,
        ]);

        return $this->officialDeleteUser($params);
    }

    /**
     * https://cloud.tencent.com/document/product/269/45939.
     *
     * @param $params
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialDeleteUser($params)
    {
        return $this->send('all_member_push/im_remove_attr', $params);
    }
}
