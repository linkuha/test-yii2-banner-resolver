<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 16.09.2018
 * Time: 17:02
 */

namespace linkuha\BannerResolver\tests;

use linkuha\BannerResolver\BannerResolver;
use \yii\base\InvalidConfigException;

class WrongHierarchyConfigTest extends TestCase
{
    protected function getBannerConfig()
    {
        return require(__DIR__ . '/config/banners-error-hierarchy.php');
    }

    /**
     * @throws \Exception
     */
    public function testConfig()
    {
        //$this->assertTrue(\Yii::$app->banners);
        $this->expectException(InvalidConfigException::class);

        /* @var $bannersComp BannerResolver */
        $bannersComp = \Yii::$app->banners;
        $bannersComp->resolveBanner([], 'RU');
    }
}