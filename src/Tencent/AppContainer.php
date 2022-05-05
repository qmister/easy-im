<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 16:13
 */

namespace whereof\easyIm\Tencent;

use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 *
 * @author qmister
 *
 * @property Request\TencentClient request
 * @property User\Clinet user
 * @property User\ProfileClient profile
 * @property User\FrientGroupClient userFrientGroup
 * @property User\FriendClient userFriend
 * @property User\BlackFriendClient userBlackFriend
 * @property Chat\UserMessageClient chat
 * @property Chat\RecentClient recent
 * @property Group\Client group
 * @property Group\UserClient groupUser
 * @property Group\NotifyClient GroupNotify
 * @property Group\MessageClient groupMessage
 * @property UserPush\UserPushClient push
 * @property UserPush\AttrNamesClient pushAtt
 * @property UserPush\TagClient pushTag
 * @property Other\OperationClient operation
 */
class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        TencentProvider::class,
    ];
}
