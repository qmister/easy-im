<?php

namespace whereof\easyIm\Jiguang;
use whereof\easyIm\Kernel\ServiceContainer;

/**
 * Class AppContainer.
 *
 * @property Request\JiguangClient request
 * @property Admin\AdminClient admin
 * @property User\UserClinet user
 * @property User\UserFriendClient userFriend
 * @property User\UserBlackClient userBlack
 * @property User\CrossUserBlackClient crossUserBlack
 * @property User\CrossUserFriendClient crossUserFriend
 * @property SensitiveWord\SensitiveWordClient sensitiveWord
 * @property Resource\ResourceClient resource
 * @property Other\CountClient count
 * @property Message\MessageClient message
 * @property Message\HistoryClient history
 * @property Message\NodisturbClient nodisturb
 * @property Message\CrossNodisturbClient crossNodisturb
 * @property Message\CrossMessageClient crossMessage
 * @property Group\GroupClient group
 * @property Group\GroupUserClient groupUser
 * @property Group\UserGroupClient userGroup
 * @property Group\CrossGroupUserClient crossGroupUser
 * @property ChatRoom\ChatRoomClient chatRoom
 */
class AppContainer extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        JiguangProvider::class,
    ];
}
