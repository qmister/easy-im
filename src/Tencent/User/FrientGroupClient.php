<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-19 22:47
 */

namespace whereof\easyIm\Tencent\User;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\UserFrientGroupInterface;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class FrientGroupClient
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\User
 */
class FrientGroupClient extends TencentClient implements UserFrientGroupInterface
{
    const NEED_FRIEND_NO = '';
    const NEED_FRIEND_YES = 'Need_Friend_Type_Yes';

    /**
     * 拉取分组
     * https://cloud.tencent.com/document/product/269/54763.
     *
     * @param $userId
     * @param int    $lastSequence 上一次拉取分组时后台返回给客户端的 Seq，初次拉取时为0，只有 GroupName 为空时有效
     * @param string $needFriend   是否需要拉取分组下的 User 列表, Need_Friend_Type_Yes: 需要拉取, 不填时默认不拉取, 只有 GroupName 为空时有效
     * @param array  $groupName    要拉取的分组名称
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function query($userId, $lastSequence = 0, $needFriend = FrientGroupClient::NEED_FRIEND_NO, array $groupName = [])
    {
        $params = [
            'From_Account' => $userId,
            'LastSequence' => $lastSequence,
            'NeedFriend'   => $needFriend,
        ];
        if (!empty($groupName)) {
            $params['GroupName'] = $groupName;
        }

        return $this->send('sns/friend_delete', $params);
    }

    /**
     * 添加分组
     * https://cloud.tencent.com/document/product/269/10107.
     *
     * @param $userId
     * @param array $groupId      新增分组列表
     * @param array $friendUserId 需要加入新增分组的好友的 UserID 列表
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function add($userId, $groupId, array $friendUserId = [])
    {
        $params = [
            'From_Account' => $userId,
            'GroupName'    => (array) $groupId,
        ];
        if (!empty($friendUserId)) {
            $params['To_Account'] = $friendUserId;
        }

        return $this->send('sns/group_add', $params);
    }

    /**
     * 删除分组
     * https://cloud.tencent.com/document/product/269/10108.
     *
     * @param $userId
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete($userId, $groupId)
    {
        $params = [
            'From_Account' => $userId,
            'GroupName'    => (array) $groupId,
        ];

        return $this->send('sns/group_delete', $params);
    }
}
