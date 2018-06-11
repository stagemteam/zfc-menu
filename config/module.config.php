<?php

namespace Stagem\ZfcMenu;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'menu' => require_once 'menu.cofig.php',

    'actions' => [
        'menu' => __NAMESPACE__ . '\Action',
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Model'],
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Model' => __NAMESPACE__ . '_driver',
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
        'prefix_template_path_stack' => [
            'menu::' => __DIR__ . '/../view/template',
        ],
    ],

    'view_helpers' => [
        'factories' => [
            'menu' => View\Helper\Factory\MenuHelperFactory::class,
        ],
    ],
];
