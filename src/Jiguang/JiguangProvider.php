<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 17:27
 */

namespace whereof\easyIm\Jiguang;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class JiguangProvider.
 *
 * @author qmister
 */
class JiguangProvider implements ServiceProviderInterface
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
            return new JiguangClient($app);
        };

        $app['user'] = function ($app) {
            return new User\UserClinet($app);
        };
        $app['userBlack'] = function ($app) {
            return new User\UserBlackClient($app);
        };
        $app['userFriend'] = function ($app) {
            return new User\UserFriendClient($app);
        };
        $app['crossUserFriend'] = function ($app) {
            return new User\CrossUserFriendClient($app);
        };
        $app['crossUserBlackC'] = function ($app) {
            return new User\CrossUserBlackClient($app);
        };

        $app['sensitiveWord'] = function ($app) {
            return new SensitiveWord\SensitiveWordClient($app);
        };

        $app['resource'] = function ($app) {
            return new Resource\ResourceClient($app);
        };

        $app['count'] = function ($app) {
            return new Other\CountClient($app);
        };

        $app['message'] = function ($app) {
            return new Message\MessageClient($app);
        };
        $app['history'] = function ($app) {
            return new Message\HistoryClient($app);
        };
        $app['nodisturb'] = function ($app) {
            return new Message\NodisturbClient($app);
        };

        $app['crossMessage'] = function ($app) {
            return new Message\CrossMessageClient($app);
        };
        $app['crossNodisturb'] = function ($app) {
            return new Message\CrossNodisturbClient($app);
        };

        $app['group'] = function ($app) {
            return new Group\GroupClient($app);
        };
        $app['groupUser'] = function ($app) {
            return new Group\GroupUserClient($app);
        };
        $app['userGroup'] = function ($app) {
            return new Group\UserGroupClient($app);
        };
        $app['crossGroupUser'] = function ($app) {
            return new Group\CrossGroupUserClient($app);
        };

        $app['chatRoom'] = function ($app) {
            return new ChatRoom\ChatRoomClient($app);
        };

        $app['admin'] = function ($app) {
            return new Admin\AdminClient($app);
        };
    }
}
