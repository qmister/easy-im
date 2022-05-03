<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-18 19:29
 */

namespace whereof\easyIm\Tencent\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\GroupUserInterface;
use whereof\easyIm\Kernel\Support\Arr;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class UserClient
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\Group
 */
class UserClient extends TencentClient implements GroupUserInterface
{
    const ROLE_MEMBER = 'Member';
    const ROLE_ADMIN = 'Admin';

    /**
     * 查询用户所加分组
     * https://cloud.tencent.com/document/product/269/1625.
     *
     * @param $userId
     * @param int $offset             从第多少个群组开始拉取
     * @param int $limit              单次拉取的群组数量，如果不填代表所有群组
     * @param int $withHugeGroups     是否获取用户加入的 AVChatRoom(直播群)，0表示不获取，1表示获取。默认为0
     * @param int $withNoActiveGroups 是否获取用户已加入但未激活的 Private（即新版本中 Work，好友工作群) 群信息，0表示不获取，1表示获取。默认为0
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function queryUserIdGroups($userId, $offset = 0, $limit = 0, $withHugeGroups = 1, $withNoActiveGroups = 1)
    {
        $params = [
            'Member_Account'     => (string) $userId,
            'WithHugeGroups'     => $withHugeGroups,
            'WithNoActiveGroups' => $withNoActiveGroups,
        ];

        if ($offset > 0) {
            $params['Offset'] = $offset;
        }
        if ($limit > 0) {
            $params['Limit'] = $limit;
        }

        return $this->send('group_open_http_svc/get_joined_group_list', $params);
    }

    /**
     * 查询群下的用户列列表
     * https://cloud.tencent.com/document/product/269/1617.
     *
     * @param $groupId
     * @param int $offset
     * @param int $limit
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function queryGroupUsers($groupId, $offset = 0, $limit = 0)
    {
        $params = [
            'GroupIdList'      => (array) $groupId,
            'Offset'           => $offset,
            'MemberInfoFilter' => [
                'Role', 'JoinTime', 'MsgSeq', 'MsgFlag', 'LastSendMsgTime', 'ShutUpUntil', 'NameCard',
            ],
        ];
        if ($limit > 0) {
            $params['Limit'] = $limit;
        }

        return $this->send('group_open_http_svc/get_group_member_info', $params);
    }

    /**
     * 更改群的所有者
     * https://cloud.tencent.com/document/product/269/1633.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function changeOwner($groupId, $userId)
    {
        $params = [
            'GroupId'          => (string) $groupId,
            'NewOwner_Account' => (string) $userId,
        ];

        return $this->send('group_open_http_svc/change_group_owner', $params);
    }

    /**
     * 用户加入群组
     * https://cloud.tencent.com/document/product/269/1621.
     *
     * @param $groupId
     * @param $userId
     * @param int $silence 是否静默加人。0：非静默加人；1：静默加人。不填该字段默认为0
     * @param int $result  加人结果：0-失败；1-成功；2-已经是群成员；3-等待被邀请者确认
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addUser($groupId, $userId, $silence = 0, $result = 1)
    {
        $params = [
            'GroupId'    => $groupId,
            'Silence'    => $silence,
            'MemberList' => Arr::buildItem($userId, 'Member_Account', [
                'Result' => $result,
            ]),
        ];

        return $this->send('group_open_http_svc/add_group_member', $params);
    }

    /**
     * 导入群成员
     * https://cloud.tencent.com/document/product/269/1636.
     *
     * @param $groupId
     * @param $userId
     * @param string $role         待导入群成员角色；目前只支持填 Admin，不填则为普通成员 Member
     * @param int    $unreadMsgNum 待导入群成员的未读消息计数
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function batchAddUser($groupId, $userId, $role = UserClient::ROLE_MEMBER, $unreadMsgNum = 0)
    {
        $params = [
            'GroupId'    => $groupId,
            'MemberList' => Arr::buildItem($userId, 'Member_Account', [
                'JoinTime'     => time(),
                'Role'         => $role,
                'UnreadMsgNum' => $unreadMsgNum,
            ]),
        ];

        return $this->send('group_open_http_svc/import_group_member', $params);
    }

    /**
     * 用户退出群组
     * https://cloud.tencent.com/document/product/269/1622.
     *
     * @param $groupId
     * @param $userId
     * @param string $reason  踢出用户原因
     * @param int    $silence 是否静默删人。0表示非静默删人，1表示静默删人。静默即删除成员时不通知群里所有成员，只通知被删除群成员。不填写该字段时默认为0
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteUser($groupId, $userId, $reason = '', $silence = 0)
    {
        $params = [
            'GroupId'             => $groupId,
            'MemberToDel_Account' => (array) $userId,
            'Silence'             => $silence,
        ];
        if ($reason !== '') {
            $params['Reason'] = $reason;
        }

        return $this->send('group_open_http_svc/delete_group_member', $params);
    }

    /**
     * 任命管理员.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addManager($groupId, $userId)
    {
        return $this->modifyUser($groupId, $userId, [
            'Role' => UserClient::ROLE_ADMIN,
        ]);
    }

    /**
     * 移除管理员.
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function removeManager($groupId, $userId)
    {
        return $this->modifyUser($groupId, $userId, [
            'Role' => UserClient::ROLE_MEMBER,
        ]);
    }

    /**
     * 设置成员的群名片.
     *
     * @param $groupId
     * @param $userId
     * @param $nameCard
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function userGroupNameCard($groupId, $userId, $nameCard)
    {
        return $this->modifyUser($groupId, $userId, [
            'NameCard' => $nameCard,
        ]);
    }

    /**
     * 修改群成员信息
     * https://cloud.tencent.com/document/product/269/1623.
     *
     * @param $groupId
     * @param $userId
     * @param array $userInfo
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function modifyUser($groupId, $userId, array $userInfo)
    {
        $params = array_merge([
            'GroupId'        => $groupId,
            'Member_Account' => $userId,
        ], $userInfo);

        return $this->send('group_open_http_svc/modify_group_member_info', $params);
    }

    /**
     * 查询禁言用户
     * https://cloud.tencent.com/document/product/269/2925.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function queryMuteUser($groupId)
    {
        $params = [
            'GroupId' => (string) $groupId,
        ];

        return $this->send('group_open_http_svc/get_group_shutted_uin', $params);
    }

    /**
     * 禁言用户.
     *
     * @param $groupId
     * @param $userId
     * @param $time
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function muteUser($groupId, $userId, $time)
    {
        return $this->modifyUser($groupId, $userId, [
            'ShutUpTime' => $time,
        ]);
    }

    /**
     * 批量禁言用户
     * https://cloud.tencent.com/document/product/269/1627.
     *
     * @param $groupId
     * @param $userId
     * @param $time
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function batchMuteUser($groupId, $userId, $time)
    {
        $params = [
            'GroupId'         => (string) $groupId,
            'Members_Account' => (array) $userId,
            'ShutUpTime'      => $time,
        ];

        return $this->send('group_open_http_svc/forbid_send_msg', $params);
    }

    /**
     * 取消禁言
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function unMuteUser($groupId, $userId)
    {
        return $this->muteUser($groupId, $userId, 0);
    }

    /**
     * 批量取消禁言
     *
     * @param $groupId
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function batchUnMuteUser($groupId, $userId)
    {
        return $this->batchMuteUser($groupId, $userId, 0);
    }
}
