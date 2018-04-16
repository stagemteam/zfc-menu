<?php

namespace Stagem\ZfcMenu;

return [
    'controllers' => [
        'aliases' => [
            'menu' => Controller\IndexController::class,
        ],
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        ],
    ],
    'controller_plugins' => [
        'aliases' => [
            'menuData' => Controller\Plugin\MenuData::class,
        ],
        /*'invokables' => [
            Controller\Plugin\MenuData::class => Controller\Plugin\MenuData::class,
        ],*/
        /*'factories' => [
        Controller\Plugin\MenuData::class => Controller\Plugin\Factory\MenuDataFactory::class,
        ],*/
        #'factories' => [
        #    Controller\Plugin\MenuData::class => function ($sm) {
        #        $plugin = new \Stagem\ZfcMenu\Controller\Plugin\MenuData();
        #        $plugin->setServiceManager($sm->getServiceLocator());

        #        return $plugin;
        #    },
        #],
    ],
    'dependencies' => [
        'aliases' => [
            'MenuService' => Service\MenuService::class,
        ],
        'invokables' => [
            Service\MenuService::class => Service\MenuService::class,
        ],
    ],
    'view_helpers' => [
        /*'aliases' => [
            'menu' => View\Helper\MenuHelper::class,
        ],
        'factories' => [
            View\Helper\MenuHelper::class => View\Helper\Factory\MenuHelperFactory::class,
        ],*/
        'factories' => [
            'menu' => View\Helper\Factory\MenuHelperFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'left-menu' => __DIR__ . '/../view/template/left-menu.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'templates' => [
        'map' => [
            'left-menu' => __DIR__ . '/../view/template/left-menu.phtml',
        ],
    ],

    'doctrine' => [
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    // pick any listeners you need
                    'Gedmo\Tree\TreeListener',
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\Sluggable\SluggableListener',
                    'Gedmo\Loggable\LoggableListener',
                    'Gedmo\Sortable\SortableListener',
                    'Gedmo\Translatable\TranslatableListener',
                ],
            ],
        ],
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                //'paths' => array(__DIR__ . '/../src/MyModule/Entity')
                'paths' => [__DIR__ . '/../src/Model'],
            ],
            'translatable_metadata_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    'vendor/gedmo/doctrine-extensions/lib/Gedmo/Translatable/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Model' => __NAMESPACE__ . '_driver',
                    'Gedmo\Translatable\Entity' => 'translatable_metadata_driver',
                ],
            ],
        ],
    ],
];
