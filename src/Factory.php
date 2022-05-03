<?php

namespace whereof\easyIm;

use InvalidArgumentException;

/**
 * Class Factory.
 *
 * @method static Tencent\AppContainer Tencent($config)
 * @method static Jiguang\AppContainer Jiguang($config)
 * @method static Huanxin\AppContainer Huanxin($config)
 * @method static RongCloud\AppContainer RongCloud($config)
 * @method static Yunxin\AppContainer Yunxin($config)
 */
class Factory
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * @param $name
     * @param array $config
     *
     * @return mixed
     */
    protected static function make($name, array $config)
    {
        $app = __NAMESPACE__.'\\'.$name.'\\AppContainer';
        if (!class_exists($app)) {
            throw new InvalidArgumentException('class not exists:'.$app);
        }
        $instance = crc32($name.serialize($config));
        if (!isset(self::$instances[$instance])) {
            self::$instances[$instance] = new $app($config);
        }

        return self::$instances[$instance];
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
