<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-19 22:04
 */

namespace whereof\easyIm\Tencent\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserFriendInterface;
use whereof\easyIm\Kernel\Support\Arr;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class FriendClient
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\User
 */
class FriendClient extends TencentClient implements UserFriendInterface
{
    /**
     * 拉去好友
     * https://cloud.tencent.com/document/product/269/1647.
     *
     * @param $userId
     * @param int $startIndex       分页的起始位置
     * @param int $standardSequence 上次拉好友数据时返回的 StandardSequence，如果 StandardSequence 字段的值与后台一致，后台不会返回标配好友数据
     * @param int $customSequence   上次拉好友数据时返回的 CustomSequence，如果 CustomSequence 字段的值与后台一致，后台不会返回自定义好友数据
     *
     * @throws GuzzleException
     *
     * @return mixed|void
     */
    public function query($userId, $startIndex = 0, $standardSequence = 0, $customSequence = 0)
    {
        $params = [
            'From_Account'     => $userId,
            'StartIndex'       => $startIndex,
            'StandardSequence' => $startIndex,
            'CustomSequence'   => $standardSequence,
        ];

        return $this->send('sns/friend_get', $params);
    }

    /**
     * 拉取指定好友
     * https://cloud.tencent.com/document/product/269/8609.
     *
     * @param $userId
     * @param $targetId
     * @param array $tagList
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function queryByUserId($userId, $targetId, $tagList = [])
    {
        $params = [
            'From_Account' => $userId,
            'To_Account'   => $targetId,
            'TagList'      => !empty($tagList) ? $tagList : [
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

        return $this->send('sns/friend_get_list', $params);
    }

    //表示单向加好友
    const ADD_SINGLE = 'Add_Type_Single';
    //表示双向加好友
    const ADD_BOTH = 'Add_Type_Both';

    /**
     * 建立关系.
     *
     * @param $userId
     * @param $toUserId
     * @param string $addType   加好友方式（默认双向加好友方式）：Add_Type_Single 表示单向加好友 Add_Type_Both 表示双向加好友
     * @param string $addSource 加好友来源字段 https://cloud.tencent.com/document/product/269/1501#.E6.A0.87.E9.85.8D.E5.A5.BD.E5.8F.8B.E5.AD.97.E6.AE.B5
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addTo($userId, $toUserId, $addType = FriendClient::ADD_BOTH, $addSource = 'easyIm')
    {
        $params = [
            'From_Account'  => $userId,
            'AddType'       => $addType,
            'AddFriendItem' => Arr::buildItem(
                $toUserId,
                'To_Account',
                [
                    'AddSource' => 'AddSource_Type_'.$addSource,
                ]
            ),
        ];

        return $this->officialAddTo($params);
    }

    /**
     * @param $userId
     * @param $toUserId
     * @param string $addSource
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchAddTo($userId, $toUserId, $addSource = 'easyIm')
    {
        $params = [
            'From_Account'  => $userId,
            'AddFriendItem' => Arr::buildItem(
                $toUserId,
                'To_Account',
                [
                    'AddSource' => 'AddSource_Type_'.$addSource,
                ]
            ),
        ];

        return $this->officialAddTo($params, true);
    }

    /**
     * 官方建立关系.
     *
     * @param array $params 提交参数
     * @param bool  $impot  是否批量
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function officialAddTo(array $params, $impot = false)
    {
        if ($impot) {
            return $this->send('sns/friend_import', $params);
        }

        return $this->send('sns/friend_add', $params);
    }

    /**
     * 更新好友信息
     * https://cloud.tencent.com/document/product/269/12525.
     *
     * @param $userId
     * @param $toUserInfo
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function update($userId, $toUserInfo)
    {
        $params = [
            'From_Account' => $userId,
            'UpdateItem'   => $toUserInfo,
        ];

        return $this->send('sns/friend_update', $params);
    }

    //单向校验好友关系
    const CHECK_BOTH = 'CheckResult_Type_Single';
    //双向校验好友关系
    const CHECK_SINGLE = 'CheckResult_Type_Both';

    /**
     * 校验好友
     * https://cloud.tencent.com/document/product/269/1646.
     *
     * @param $useId
     * @param $toUserId
     * @param string $checkType 单向校验好友关系 CheckResult_Type_Single 双向校验好友关系 CheckResult_Type_Both
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function check($useId, $toUserId, $checkType = FriendClient::CHECK_SINGLE)
    {
        $params = [
            'From_Account' => $useId,
            'To_Account'   => $toUserId,
            'CheckType'    => $checkType,
        ];

        return $this->send('sns/friend_check', $params);
    }

    //单向删除好友
    const DELETE_BOTH = 'Delete_Type_Both';
    //双向删除好友
    const DELETE_SINGLE = 'Delete_Type_Single';

    /**
     * 移除关系
     * https://cloud.tencent.com/document/product/269/1644.
     *
     * @param $useId
     * @param $toUserId
     * @param string $deleteType 删除模式 单向删除好友 Delete_Type_Single 双向删除好友 Delete_Type_Both
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function remove($useId, $toUserId, $deleteType = FriendClient::DELETE_BOTH)
    {
        $params = [
            'From_Account' => $useId,
            'To_Account'   => $toUserId,
            'DeleteType'   => $deleteType,
        ];

        return $this->send('sns/friend_delete', $params);
    }

    /**
     * 删除所有好友
     * https://cloud.tencent.com/document/product/269/1645.
     *
     * @param $userId
     * @param string $deleteType
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchRemove($userId, $deleteType = 'Delete_Type_Both')
    {
        $params = [
            'From_Account' => $userId,
            'DeleteType'   => $deleteType,
        ];

        return $this->send('sns/friend_delete_all', $params);
    }
}
