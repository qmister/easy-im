<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-24 11:27
 */

namespace whereof\easyIm\Jiguang\Other;

use GuzzleHttp\Exception\GuzzleException;
use whereof\easyIm\Jiguang\Request\JiguangClient;

/**
 * Class CountClient.
 *
 * @author qmister
 */
class CountClient extends JiguangClient
{
    /**
     * 用户统计
     *
     * @param string $start    开始时间 time_unit 为DAY的时候格式为yyyy-MM-dd
     * @param int    $duration (必填) 请求时的持续时长，DAY 最大为60天
     * @param string $timeUnit （必填）查询维度 目前只有 DAY
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function user($start, $duration = 60, $timeUnit = 'DAY')
    {
        $params = [
            'time_unit' => $timeUnit,
            'start'     => $start,
            'duration'  => $duration,
        ];

        return $this->send('GET', 'v2/statistic/users', $params, true);
    }

    /**
     * 消息统计
     *
     * @param string $start    开始时间 time_unit 为DAY的时候格式为yyyy-MM-dd
     * @param int    $duration (必填) 请求时的持续时长，DAY 最大为60天
     * @param string $timeUnit （必填）查询维度 目前只有 DAY
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function message($start, $duration = 60, $timeUnit = 'DAY')
    {
        $params = [
            'time_unit' => $timeUnit,
            'start'     => $start,
            'duration'  => $duration,
        ];

        return $this->send('GET', 'v2/statistic/messages', $params, true);
    }

    /**
     * 群组统计
     *
     * @param string $start    开始时间 time_unit 为DAY的时候格式为yyyy-MM-dd
     * @param int    $duration (必填) 请求时的持续时长，DAY 最大为60天
     * @param string $timeUnit （必填）查询维度 目前只有 DAY
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function group($start, $duration = 60, $timeUnit = 'DAY')
    {
        $params = [
            'time_unit' => $timeUnit,
            'start'     => $start,
            'duration'  => $duration,
        ];

        return $this->send('GET', 'v2/statistic/groups', $params, true);
    }
}
