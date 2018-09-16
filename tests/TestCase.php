<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 15.09.2018
 * Time: 3:19
 */

namespace linkuha\BannerResolver\tests;

use yii\console\Application;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    private $config;

    protected function getBannerConfig()
    {
        return require(__DIR__.'/config/banners.php');
    }


    protected function setConfig()
    {
        $this->config = [
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => dirname(__DIR__) . '/vendor',
            'components' => [
                'banners' => $this->getBannerConfig(),
            ],
        ];
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function setUp()
    {
        parent::setUp();
        $this->setConfig();
        $this->mockApplication();
    }

    protected function tearDown()
    {
        $this->destroyApplication();
        parent::tearDown();
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function mockApplication()
    {
        new Application($this->config);

    }

    protected function destroyApplication()
    {
        \Yii::$app = null;
    }
}