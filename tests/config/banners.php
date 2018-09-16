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
        1 => [
            'type' => 'region',
            'value' => 'US',
            'children' => [
                1 => [
                    'type' => 'percent',
                    'value' => '15',
                    'return' => 'banner1.jpg'
                ],
                2 => [
                    'type' => 'percent',
                    'value' => '85',
                    'return' => 'banner2.jpg'
                ]
            ],
        ],
        2 => [
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
        3 => [
            'type' => 'percent',
            'value' => '100',
            'return' => 'banner6.jpg'
        ]
    ],
];