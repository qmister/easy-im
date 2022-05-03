<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-18 16:37
 */

namespace whereof\easyIm\Kernel\Interfaces;

/**
 * 群组管理.
 *
 * @author zhiqiang
 * Interface GroupInterface
 */
interface GroupInterface
{
    /**
     * 所有群组.
     *
     * @return mixed
     */
    public function groupList();

    /**
     * 创建群.
     *
     * @param string $groupId 群组标识
     *
     * @return mixed
     */
    public function create($groupId);

    /**
     * 群信息.
     *
     * @param $groupId
     *
     * @return mixed
     */
    public function info($groupId);

    /**
     * 修改群.
     *
     * @param $groupId
     * @param string $name   群名称
     * @param string $desc   群描述
     * @param string $avatar 群头像
     *
     * @return mixed
     */
    public function update($groupId, $name, $desc, $avatar);

    /**
     * 删除（解散群）.
     *
     * @param $groupId
     *
     * @return mixed
     */
    public function destroy($groupId);
}
