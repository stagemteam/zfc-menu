<?php

namespace Stagem\ZfcMenu;

return [
    /*it's key of menu section*/
    /*required*/
    'materials_log2' => [
        /*this option allows lower down menu level*/
        //'is_anchor' => true,
        /*required*/
        'label' => 'Materials Log 2',
        /*required*/
        'translator' => 'label',
        /*required*/
        'sort_order' => '10',
        /*this option allows to hide this section*/
        'is_visible' => true,

        /*if you want to use image for this menu section you should write url*/
        'icon-class' => 'glyphicon glyphicon-cloud',
        /* here you should write a route and params for action*/
        'action' => [
            'route' => 'admin/default',
            'params' => [
                'controller' => 'question',
                'action' => 'after-create',
            ],
        ],
    ],

    'materials_log3' => [
        /*this option allows lower down menu level*/
        //'is_anchor' => true,
        /*required*/
        'label' => 'Materials Log 3 ',
        /*required*/
        'translator' => 'label',
        /*required*/
        'sort_order' => '12',
        /*this option allows to hide this section*/
        'is_visible' => true,
        'icon-class' => 'glyphicon glyphicon-cloud',
        /* here you should write a route and params for action*/
        'action' => [
            'route' => 'admin/default',
            'params' => [
                'controller' => 'question',
                'action' => 'after-create',
            ],
        ],
    ],

    'materials_log1' => [
        /*this option allows lower down menu level*/
        //'is_anchor' => true,
        /*required*/
        'label' => 'Materials Log 1',
        /*required*/
        'translator' => 'label',
        /*required*/
        'sort_order' => '5',
        /*this option allows to hide this section*/
        'is_visible' => true,

        /*if you want to use image for this menu section you should write url*/
        'icon-class' => 'glyphicon glyphicon-cloud',
        /* here you should write a route and params for action*/
        'action' => [
            'route' => 'admin/default',
            'params' => [
                'controller' => 'patient',
                'action' => 'create',
            ],
        ],
    ],
];
