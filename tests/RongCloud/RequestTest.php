<?php


namespace whereof\easyIm\Tests\RongCloud;

use whereof\easyIm\RongCloud\Request\RongCloudClient;
use whereof\easyIm\Tests\TestCase;

class RequestTest extends TestCase
{
    public function testGetToken()
    {
        $app = $this->RongCloud();
        $client = $this->mockApiClient(RongCloudClient::class, $app);
        $params = [
            'userId' => 'test',
        ];
        $resp = $client->send('user/getToken.json', $params);
        $data = json_decode($resp, true);
        $this->assertIsArray($data);
    }
}
