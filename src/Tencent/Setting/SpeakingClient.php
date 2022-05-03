<?php
/*
 * Desc:
 * User: zhiqiang
 * Date: 2021-10-20 22:43
 */

namespace whereof\easyIm\Tencent\Setting;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Tencent\Request\TencentClient;


/**
 * Class SpeakingClient
 * @author zhiqiang
 * @package whereof\easyIm\Tencent\Setting
 */
class SpeakingClient extends TencentClient
{
    /**
     * https://cloud.tencent.com/document/product/269/4229
     * 查询全局禁言
     *
     * @param $userId
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function query($userId)
    {
        return $this->send('openconfigsvr/getnospeaking', [
            'Get_Account' => $userId,
        ]);
    }

    /**
     * 设置全局禁言
     * https://cloud.tencent.com/document/product/269/4230.
     *
     * @param $userId
     * @param int $c2CmsgNospeakingTime   单聊消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）
     * @param int $groupmsgNospeakingTime 群组消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function set($userId, int $c2CmsgNospeakingTime = null, int $groupmsgNospeakingTime = null)
    {
        $params = [
            'Set_Account' => (string) $userId,
        ];
        if (!is_null($c2CmsgNospeakingTime)) {
            $params['C2CmsgNospeakingTime'] = $c2CmsgNospeakingTime;
        }
        if (!is_null($groupmsgNospeakingTime)) {
            $params['GroupmsgNospeakingTime'] = $groupmsgNospeakingTime;
        }

        return $this->send('openconfigsvr/setnospeaking', $params);
    }
}
