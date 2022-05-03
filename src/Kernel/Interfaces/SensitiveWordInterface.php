<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-25 22:00
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * 敏感词.
 *
 * @author zhiqiang
 * Interface SensitiveWord
 */
interface SensitiveWordInterface
{
    /**
     * 获取敏感词列表.
     *
     * @return mixed
     */
    public function listAll();

    /**
     * 添加敏感词.
     *
     * @param $word
     *
     * @return mixed
     */
    public function add($word);

    /**
     * 移除敏感词.
     *
     * @param $word
     *
     * @return mixed
     */
    public function delete($word);
}
