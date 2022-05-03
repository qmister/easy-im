<?php


namespace whereof\easyIm\Tests;

use whereof\easyIm\Huanxin\Request\HuanxinClient;
use whereof\easyIm\Jiguang\Request\JiguangClient;
use whereof\easyIm\RongCloud\Request\RongCloudClient;
use whereof\easyIm\Tencent\Request\TencentClient;
use whereof\easyIm\Yunxin\AppContainer;
use whereof\easyIm\Yunxin\Request\YunxinClient;

class FactoryTest extends TestCase
{
    public function testHuanxin()
    {
        $app = $this->Huanxin();
        $this->assertInstanceOf(\whereof\easyIm\Huanxin\AppContainer::class, $app);

        $this->assertInstanceOf(\whereof\easyIm\Huanxin\Request\HuanxinClient::class, $app->request);

    }

    public function testJiguang()
    {
        $app = $this->Jiguang();
        $this->assertInstanceOf(\whereof\easyIm\Jiguang\AppContainer::class, $app);
        $this->assertInstanceOf(\whereof\easyIm\Jiguang\Request\JiguangClient::class, $app->request);
    }

    public function testRongCloud()
    {
        $app = $this->RongCloud();
        $this->assertInstanceOf(\whereof\easyIm\RongCloud\AppContainer::class, $app);

        $this->assertInstanceOf(\whereof\easyIm\RongCloud\Request\RongCloudClient::class, $app->request);

    }

    public function testTencent()
    {
        $app = $this->Tencent();
        $this->assertInstanceOf(\whereof\easyIm\Tencent\AppContainer::class, $app);

        $this->assertInstanceOf(\whereof\easyIm\Tencent\Request\TencentClient::class, $app->request);
    }

    public function testYunxin()
    {
        $app = $this->Yunxin();

        $this->assertInstanceOf(\whereof\easyIm\Yunxin\AppContainer::class, $app);
        $this->assertInstanceOf(\whereof\easyIm\Yunxin\Request\YunxinClient::class, $app->request);

    }
}