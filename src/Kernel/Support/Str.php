<?php

namespace whereof\easyIm\Kernel\Support;
 */
class Str
{
    /**
     * 去掉第一位为/字符串
     * @param $str
     * @return bool|string
     */
    public static function removeFristSlash($str)
    {
        if (substr($str, 0, 1) === '/') {
            return substr($str, 1);
        }
        return $str;
    }
}