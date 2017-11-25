<?php

return [

    // Default billing periods
    'periods'   =>  [

        [
            'key'           =>  'monthly',
            'days'          =>  30,
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Monthly'
                ]
            ]
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
            'key'           =>  'Semi-annually',
            'days'          =>  180,
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Semi-annually'
                ]
            ]
        ],
        [
            'key'           =>  'Annually',
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
            'key'           =>  'premium',
            'translations'  =>  [
                'en'    =>  [
                    'name'  =>  'Premium',
                ]
            ]
        ]
    ],

];
