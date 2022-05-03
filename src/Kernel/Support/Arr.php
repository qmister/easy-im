<?php

namespace whereof\easyIm\Kernel\Support;

class Arr
{
    /**
     * Arr::buildItem(['userID_1','userID_2'], 'uid', ['name' => 'whereof']);.
     *
     * Arr::buildItem('userId_1', 'uid', ['name' => 'whereof']);
     *
     * @param $ids
     * @param string $idKey
     * @param array $expand
     *
     * @return array
     */
    public static function buildItem($ids, $idKey, array $expand = [])
    {
        $newArr = [];
        if (is_string($ids) || is_numeric($ids)) {
            $item[$idKey] = $ids;
            $newArr[]     = array_merge($item, $expand);
        }
        if (is_array($ids)) {
            foreach ($ids as $uid) {
                $item[$idKey] = $uid;
                $newArr[]     = array_merge($item, $expand);
            }
        }
        return $newArr;
    }
}
