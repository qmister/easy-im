<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-21 22:26
 */

namespace whereof\easyIm\Tencent\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class ProfileClient
 * @author qmister
 * @package whereof\easyIm\Tencent\User
 */
class ProfileClient extends TencentClient
{
    /**
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($userId, $tagList = [])
    {
        $params = [
            'To_Account' => $userId,
            'TagList'    => !empty($tagList) ? $tagList : [
                'Tag_Profile_IM_Nick',
                'Tag_Profile_IM_Gender',
                'Tag_Profile_IM_BirthDay',
                'Tag_Profile_IM_Location',
                'Tag_Profile_IM_SelfSignature',
                'Tag_Profile_IM_AllowType',
                'Tag_Profile_IM_Language',
                'Tag_Profile_IM_Image',
                'Tag_Profile_IM_MsgSettings',
                'Tag_Profile_IM_AdminForbidType',
                'Tag_Profile_IM_Level',
                'Tag_Profile_IM_Role',
            ],
        ];

        return $this->send('profile/portrait_set', $params);
    }

    /**
     * 设置资料
     * https://cloud.tencent.com/document/product/269/1640.
     *
     * @param $userId
     * @param $info
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function set($userId, $info)
    {
        $params = [
            'From_Account' => $userId,
            'ProfileItem'  => $info,
        ];

        return $this->send('profile/portrait_set', $params);
    }
}
