<?php

return [
    'available' => [
        'line',
        'area',
        'column',
        'bar',
        'pie'
    ],

    'charts' => [
        'line' => [
            'logo' => '/images/linechart.png',
            'fields' => [
                'title' => [
                    'required' => false,
                    'type' => 'String'
                ],
                'subtitle' => [
                    'required' => false,
                    'type' => 'String'
                ],
                'yaxis_title' => [
                    'required' => true,
                    'type' => 'String'
                ],
                'xaxis_title' => [
                    'required' => true,
                    'type' => 'String'
                ],
            ]
        ]
    ]
];
