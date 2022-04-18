<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-17 17:44
 */

namespace qmister\easyIm\Tests;

/**
 * Class FactoryTest.
 *
 * @author qmister
 */
class FactoryTest extends TestCase
{
    public function testHuanxin()
    {
        $app = $this->Huanxin();
        $this->assertInstanceOf(\qmister\easyIm\Huanxin\AppContainer::class, $app);
        $this->assertInstanceOf(\qmister\easyIm\Huanxin\Request\HuanxinClient::class, $app->request);
    }

    public function testJiguang()
    {
        $app = $this->Jiguang();
        $this->assertInstanceOf(\qmister\easyIm\Jiguang\AppContainer::class, $app);
        $this->assertInstanceOf(\qmister\easyIm\Jiguang\Request\JiguangClient::class, $app->request);
    }

    public function testRongCloud()
    {
        $app = $this->RongCloud();
        $this->assertInstanceOf(\qmister\easyIm\RongCloud\AppContainer::class, $app);
        $this->assertInstanceOf(\qmister\easyIm\RongCloud\Request\RongCloudClient::class, $app->request);
    }

    public function testTencent()
    {
        $app = $this->Tencent();
        $this->assertInstanceOf(\qmister\easyIm\Tencent\AppContainer::class, $app);
        $this->assertInstanceOf(\qmister\easyIm\Tencent\Request\TencentClient::class, $app->request);
    }

    public function testYunxin()
    {
        $app = $this->Yunxin();
        $this->assertInstanceOf(\qmister\easyIm\Yunxin\AppContainer::class, $app);
        $this->assertInstanceOf(\qmister\easyIm\Yunxin\Request\YunxinClient::class, $app->request);
    }
}
