<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 16.09.2018
 * Time: 6:00
 */

return [
    'class' => linkuha\BannerResolver\BannerResolver::class,
    'rules' => [
        5 => [
            'type' => 'percent',
            'value' => '15',
            'children' => [ // ERROR (must no children for percent)
                1 => [
                    'type' => 'percent',
                    'value' => '15',
                    'return' => 'banner1.jpg'
                ],
                2 => [
                    'type' => 'percent',
                    'value' => '85',
                    'return' => 'banner2.jpg'
                ],
                3 => [
                    'type' => 'region',
                    'value' => 'RU',
                    'children' => [
                        1 => [
                            'type' => 'param',
                            'key' => 'test',
                            'value' => '1',
                            'return' => 'banner3.jpg'
                        ],
                    ],
                ],
            ],
        ],
    ],
];