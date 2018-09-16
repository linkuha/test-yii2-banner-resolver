### Banner Resolver component

This is the Yii2 component for resolve what a banner is suitable for user with his query parameters, region (for example, by ip geolocation), and percent probabilities. You can to configure own rules for resolving a content.

As banner you can use any string, url, html code.

To install you need run comand (without `--no-dev` for testing capability support):
```
composer require linkuha/yii2-banner-resolver
```

**Tested on:** <br/>
PHP 7.2.0 <br/>
Yii 2.0.14
Composer version 1.7.1 <br/>
PHPUnit 7.3.5


**Rules types:**

- Region (country code with 2 symbols, you can get code from any IP Geo Location module, for example, if you have)
```PHP
$RU = Yii::$app->geoip->lookupLocation('37.194.xxx.xxx')->countryCode;
```
- Percent (chance of choosing this rule with concrete probability. **NOT** can contain childrens due to his logic)
- Parameter (you can sent any array, e.g. request parameters array. resolver return a banner from rule matched to parameter)


Create in config directory file `banners.php`. And add configuration into your `'components' => [...]` section, for example:
```php
$banners = require __DIR__ . '/banners.php';
...
'components' => [
    ...,
    'banners' => $banners,
]
```

Contains of config `banners.php` is may to be hierarchy with children key of associative array. Example:
```php
<?php
return [
    'class' => linkuha\BannerResolver\BannerResolver::class,
    'rules' => [
        1 => [
            'type' => 'region',
            'value' => 'RU',
            'children' => [
                1 => [
                    'type' => 'param',
                    'key' => 'test',
                    'value' => '1',
                    'return' => 'banner3.jpg'
                ],
                2 => [
                    'type' => 'percent',
                    'value' => '70',
                    'return' => 'banner4.jpg'
                ],
                3 => [
                    'type' => 'percent',
                    'value' => '30',
                    'return' => 'banner5.jpg'
                ]
            ],
        ],
        2 => [
            'type' => 'percent',
            'value' => '100',
            'return' => 'banner6.jpg'
        ]
    ],
];
```
So finally, use:
```
$code = Yii::$app->geoip->lookupLocation('37.194.xxx.xxx')->countryCode;
$bannersComp = Yii::$app->banners;
$bannerUrl = $bannersComp->resolveBanner($query, $code)->getUrl(),
```

**To run a tests:**
```
vendor/bin/phpunit
```
