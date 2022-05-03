<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-17 22:22
 */

namespace whereof\easyIm\Tencent\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserInterface;
use whereof\easyIm\Kernel\Support\Arr;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class Clinet
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\User
 */
class Clinet extends TencentClient implements UserInterface
{
    /**
     * 导入单个帐号
     * https://cloud.tencent.com/document/product/269/1608.
     *
     * @param $userId
     * @param null $nickname
     * @param null $faceUrl
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function create($userId, $nickname = null, $faceUrl = null)
    {
        $params = [
            'Identifier' => $userId,
            'Nick'       => $nickname ?? uniqid('easyIm_'),
            'FaceUrl'    => $faceUrl ?? '',
        ];

        return $this->send('im_open_login_svc/account_import', $params);
    }

    /**
     * 导入多个帐号
     * https://cloud.tencent.com/document/product/269/4919.
     *
     * @param array $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchCreate(array $userId)
    {
        $params = [
            'Accounts' => $userId,
        ];

        return $this->send('im_open_login_svc/multiaccount_import', $params);
    }

    /**
     * 查询帐号
     * https://cloud.tencent.com/document/product/269/38417.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function info($userId)
    {
        $params = [
            'CheckItem' => Arr::buildItem($userId, 'UserID'),
        ];

        return $this->send('im_open_login_svc/account_check', $params);
    }

    /**
     * 删除帐号
     * https://cloud.tencent.com/document/product/269/36443.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function delete($userId)
    {
        $params = [
            'DeleteItem' => Arr::buildItem($userId, 'UserID'),
        ];

        return $this->send('im_open_login_svc/account_delete', $params);
    }

    /**
     * 查询帐号在线状态
     * https://cloud.tencent.com/document/product/269/2566.
     *
     * @param $userId
     * @param int $isNeedDetail
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function status($userId, int $isNeedDetail = null)
    {
        $params = [
            'To_Account'   => (array) $userId,
            'IsNeedDetail' => $isNeedDetail ?? 1,
        ];

        return $this->send('openim/querystate', $params);
    }

    /**
     * 失效帐号登录状态
     * https://cloud.tencent.com/document/product/269/3853.
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function expire($userId)
    {
        $params = [
            'Identifier' => (string) $userId,
        ];

        return $this->send('im_open_login_svc/kick', $params);
    }
}
