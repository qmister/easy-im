<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-17 16:14
 */

namespace whereof\easyIm\Tencent;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class TencentProvider.
 *
 * @author zhiqiang
 */
class TencentProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $app
     */
    public function register(Container $app)
    {
        // TODO: Implement register() method.
        $app['request'] = function ($app) {
            return new Request\TencentClient($app);
        };
        $app['user'] = function ($app) {
            return new User\Clinet($app);
        };
        $app['profile'] = function ($app) {
            return new User\ProfileClient($app);
        };
        $app['userFrientGroup'] = function ($app) {
            return new User\FrientGroupClient($app);
        };
        $app['userFriend'] = function ($app) {
            return new User\FriendClient($app);
        };
        $app['userBlackFriend'] = function ($app) {
            return new User\BlackFriendClient($app);
        };

        $app['chat'] = function ($app) {
            return new Chat\UserMessageClient($app);
        };
        $app['recent'] = function ($app) {
            return new Chat\RecentClient($app);
        };

        $app['group'] = function ($app) {
            return new Group\Client($app);
        };
        $app['groupMessage'] = function ($app) {
            return new Group\MessageClient($app);
        };
        $app['groupMessageCount'] = function ($app) {
            return new Group\MessageCountClient($app);
        };
        $app['groupNotify'] = function ($app) {
            return new Group\NotifyClient($app);
        };
        $app['groupUser'] = function ($app) {
            return new Group\UserClient($app);
        };

        $app['push'] = function ($app) {
            return new UserPush\UserPushClient($app);
        };
        $app['pushTag'] = function ($app) {
            return new UserPush\TagClient($app);
        };
        $app['pushAtt'] = function ($app) {
            return new UserPush\AttrNamesClient($app);
        };

        $app['operation'] = function ($app) {
            return new Other\OperationClient($app);
        };
    }
}
