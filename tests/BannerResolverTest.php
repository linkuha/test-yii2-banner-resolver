<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 16.09.2018
 * Time: 16:35
 */
namespace linkuha\BannerResolver\tests;

use linkuha\BannerResolver\BannerResolver;

class BannerResolverTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCountry()
    {
        /* @var $bannersComp BannerResolver */
        $bannersComp = \Yii::$app->banners;

        $result = $bannersComp->resolveBanner([], 'RU')->getString();
        $this->assertTrue($result == 'banner4.jpg' || $result == 'banner5.jpg');

        $result = $bannersComp->resolveBanner([], 'US')->getString();
        $this->assertTrue($result == 'banner1.jpg' || $result == 'banner2.jpg');

        $result = $bannersComp->resolveBanner([], 'KZ')->getString();
        $this->assertTrue($result == 'banner6.jpg');
    }

    /**
     * @throws \Exception
     */
    public function testParameter()
    {
        $queryParams = [
            'test' => '1'
        ];

        /* @var $bannersComp BannerResolver */
        $bannersComp = \Yii::$app->banners;

        $result = $bannersComp->resolveBanner($queryParams, 'RU')->getString();
        $this->assertTrue($result == 'banner3.jpg');
    }
}