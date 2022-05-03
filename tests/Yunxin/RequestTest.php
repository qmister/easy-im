<?php


namespace whereof\easyIm\Tests\Yunxin;


use whereof\easyIm\Tests\TestCase;
use whereof\easyIm\Yunxin\Request\YunxinClient;

class RequestTest extends TestCase
{
    public function testUserCreate()
    {
        $app = $this->Yunxin();
        $client = $this->mockApiClient(YunxinClient::class, $app);
        $params = [
            'accid' => 'easyim',
        ];
        $resp = $client->send('nimserver/user/create.action', $params);
        $data = json_decode($resp, true);
        $this->assertIsArray($data);
    }
}
