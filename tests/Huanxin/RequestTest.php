<?php

namespace whereof\easyIm\Tests\Huanxin;

use whereof\easyIm\Huanxin\Request\HuanxinClient;
use whereof\easyIm\Tests\TestCase;

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
