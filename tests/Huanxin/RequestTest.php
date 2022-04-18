<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 22:15
 */

namespace qmister\easyIm\Tests\Huanxin;

use qmister\easyIm\Huanxin\Request\HuanxinClient;
use qmister\easyIm\Tests\TestCase;

class RequestTest extends TestCase
{
    public function testGetToken()
    {
        $app = $this->Huanxin();
        $client = $this->mockApiClient(HuanxinClient::class, $app);
        $resp = $client->getToken();
        $data = json_decode($resp, true);
        $this->assertIsArray($data);
    }
}
