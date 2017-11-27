<?php

return [

    'currencies'    =>  [
        [
            'key'       =>  'euro',
            'symbol'    =>  '€',
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Euro'
                ]
            ]
        ],
        [
            'key'       =>  'usd',
            'symbol'    =>  '$',
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'USD'
                ]
            ]
        ],
        [
            'key'       =>  'gbp',
            'symbol'    =>  '£',
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'GBP'
                ]
            ]
        ],
        [
            'key'       =>  'sar',
            'symbol'    =>  '﷼',
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'SAR'
                ]
            ]
        ],
    ],

    // Default billing periods
    'periods'   =>  [

        [
            'key'           =>  'monthly',
            'days'          =>  30,
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Monthly'
                ]
            ],
        ],
        [
            'key'           =>  'quartetly',
            'days'          =>  90,
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Quarterly'
                ]
            ]
        ],
        [
            'key'           =>  'semi-annually',
            'days'          =>  180,
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Semi-annually'
                ]
            ]
        ],
        [
            'key'           =>  'annually',
            'days'          =>  365,
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Annually'
                ]
            ]
        ],

    ],

    'plans' =>  [
        [
            'key'           =>  'free',
            'prices'        =>  [
                [
                    'period'        =>  'monthly',
                    'monthly_price' =>  0
                ],
            ],
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Free',
                ]
            ],
            'settings'  =>  [
                'total_downloads'   =>  [
                    'type'  =>  'integer',
                    'value' =>  10
                ],
                'monthly_downloads' =>  [
                    'type'  =>  'integer',
                    'value' =>  2
                ],
                'available_content' =>  [
                    'type'  =>  'integer',
                    'value' =>  20
                ],
            ]
        ],
        [
            'key'           =>  'premium',
            'prices'        =>  [
                [
                    'period'        =>  'monthly',
                    'monthly_price' =>  11.99
                ],
                [
                    'period'        =>  'annually',
                    'monthly_price' =>  9.99
                ],

            ],
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Premium',
                ]
            ],
            'settings'  =>  [
                'total_downloads'   =>  [
                    'type'  =>  'integer',
                    'value' =>  20
                ],
                'monthly_downloads' =>  [
                    'type'  =>  'integer',
                    'value' =>  20
                ],
                'available_content' =>  [
                    'type'  =>  'integer',
                    'value' =>  60
                ],
            ]
        ],
        [
            'key'           =>  'premium_plus',
            'prices'        =>  [
                [
                    'period'        =>  'monthly',
                    'monthly_price' =>  21.99
                ],
                [
                    'period'        =>  'annually',
                    'monthly_price' =>  19.99
                ]
            ],
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Premium Plus',
                ]
            ],
            'settings'  =>  [
                'total_downloads'   =>  [
                    'type'  =>  'integer',
                    'value' =>  40
                ],
                'monthly_downloads' =>  [
                    'type'  =>  'integer',
                    'value' =>  40
                ],
                'available_content' =>  [
                    'type'  =>  'integer',
                    'value' =>  100
                ],
            ]
        ]
    ],

];
