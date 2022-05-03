<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-18 17:13
 */

namespace whereof\easyIm\Tencent\Group;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Kernel\Interfaces\GroupInterface;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * 群组管理
 * https://cloud.tencent.com/document/product/269/1614
 * Class Client
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\Group
 */
class Client extends TencentClient implements GroupInterface
{
    const TYPE_PUBLIC = 'Public';
    const TYPE_PRIVATE = 'Private';
    const TYPE_CHATROOM = 'ChatRoom';
    const TYPE_AVCHATROOM = 'AVChatRoom';
    const TYPE_BCHATROOM = 'BChatRoom';

    /**
     * 获取 App 中的所有群组
     * https://cloud.tencent.com/document/product/269/1614.
     *
     * @param int    $limit     本次获取的群组 ID 数量的上限，不得超过 10000。如果不填，默认为最大值 10000
     * @param int    $next      群太多时分页拉取标志，第一次填0，以后填上一次返回的值，返回的 Next 为0代表拉完了
     * @param string $groupType 群组形态包括 Public（公开群），Private（私密群），ChatRoom（聊天室），AVChatRoom（音视频聊天室）和 BChatRoom（在线成员广播大群）
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function groupList($limit = 10000, $next = 0, $groupType = '')
    {
        $params = [
            'Limit' => $limit,
            'Next'  => $next,
        ];
        if ($groupType) {
            $params['GroupType'] = $groupType;
        }

        return $this->send('group_open_http_svc/get_appid_group_list', $params);
    }

    const JOIN_FREE = 'FreeAccess';
    const JOIN_NEED = 'NeedPermission';
    const JOIN_DISABLE = 'DisableApply';

    /**
     * 创建群
     * https://cloud.tencent.com/document/product/269/1615.
     *
     * @param $groupId
     * @param string $userId          群主 ID（需是 已导入 的账号）。填写后自动添加到群成员中；如果不填，群没有群主
     * @param string $type            群组形态，包括 Public（陌生人社交群），Private（即 Work，好友工作群），ChatRoom（即 Meeting，会议群），AVChatRoom（直播群）
     * @param array  $userList        初始群成员列表，最多100个
     * @param string $desc            群简介，最长240字节，使用 UTF-8 编码，1个汉字占3个字节
     * @param string $avatar          群头像 URL，最长100字节
     * @param string $notification    群公告，最长300字节，使用 UTF-8 编码，1个汉字占3个字节
     * @param int    $maxMemberCount  最大群成员数量，缺省时的默认值：付费套餐包上限，例如体验版是20，如果升级套餐包，需按照修改群基础资料修改这个字段
     * @param string $applyJoinOption 申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群），不填默认为 NeedPermission（需要验证）
     * @param string $name            群名称，最长30字节，使用 UTF-8 编码，1个汉字占3个字节
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create($groupId, $userList = [], $userId = '', $type = Client::TYPE_PUBLIC, $desc = '', $avatar = '', $notification = '', $maxMemberCount = 20, $applyJoinOption = Client::JOIN_NEED, $name = '')
    {
        $params = [
            'Type'    => $type,
            'GroupId' => $groupId,
            'Name'    => empty($name) ? $groupId : $name,
        ];
        if (empty($userId)) {
            $params['Owner_Account'] = $userId;
        }
        if (empty($desc)) {
            $params['Introduction'] = $desc;
        }
        if (empty($avatar)) {
            $params['FaceUrl'] = $avatar;
        }
        if ($notification !== '') {
            $params['Notification'] = $notification;
        }
        if ($maxMemberCount) {
            $params['MaxMemberCount'] = $maxMemberCount;
        }
        if ($applyJoinOption !== '') {
            $params['ApplyJoinOption'] = $applyJoinOption;
        }
        if (empty($userList)) {
            $params['MemberList'] = $userList;
        }

        return $this->send('group_open_http_svc/create_group', $params);
    }

    /**
     * 群信息
     * https://cloud.tencent.com/document/product/269/1616.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function info($groupId)
    {
        $params = [
            'GroupIdList'    => (array) $groupId,
            'ResponseFilter' => [
                'GroupBaseInfoFilter' => ['Type', 'Name', 'Introduction', 'Notification'],
                'MemberInfoFilter'    => ['Account', 'Role'],
            ],
        ];

        return $this->send('group_open_http_svc/get_group_info', $params);
    }

    /**
     * 修改群
     * https://cloud.tencent.com/document/product/269/1620.
     *
     * @param $groupId
     * @param string $name            群名称
     * @param string $desc            群简介
     * @param string $avatar          群头像
     * @param string $notification    群公告
     * @param int    $maxMemberCount  最大群成员数量（选填）
     * @param string $applyJoinOption 申请加群方式（选填）
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update($groupId, $name = '', $desc = '', $avatar = '', $notification = '', $maxMemberCount = 0, $applyJoinOption = '')
    {
        $params = [
            'GroupId' => $groupId,
        ];
        if ($name) {
            $params['Name'] = $name;
        }
        if ($desc) {
            $params['Introduction'] = $desc;
        }
        if ($avatar) {
            $params['FaceUrl'] = $avatar;
        }
        if ($notification) {
            $params['Notification'] = $notification;
        }
        if ($maxMemberCount) {
            $params['MaxMemberCount'] = $maxMemberCount;
        }
        if ($applyJoinOption !== '') {
            $params['ApplyJoinOption'] = $applyJoinOption;
        }

        return $this->send('group_open_http_svc/modify_group_base_info', $params);
    }

    /**
     * 删除（解散群）
     * https://cloud.tencent.com/document/product/269/1624.
     *
     * @param $groupId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function destroy($groupId)
    {
        $params = [
            'GroupId' => $groupId,
        ];

        return $this->send('group_open_http_svc/destroy_group', $params);
    }
}
