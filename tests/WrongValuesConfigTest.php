<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 16.09.2018
 * Time: 17:02
 */

namespace linkuha\BannerResolver\tests;


use linkuha\BannerResolver\BannerResolver;

class WrongValuesConfigTest extends TestCase
{
    protected function getBannerConfig()
    {
        return require(__DIR__ . '/config/banners-error-values.php');
    }

    /**
     * @throws \Exception
     */
    public function testConfig()
    {
        $this->expectExceptionMessage("Banners config not correct (percentage in rule)");

        /* @var $bannersComp BannerResolver */
        $bannersComp = \Yii::$app->banners;
        $bannersComp->resolveBanner([], 'RU');
    }
}