<?php
namespace Agere\Menu;

return array(
	
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
		'factories' => array(
				Controller\Plugin\MenuData::class => function($sm) {
				$plugin = new \Agere\Menu\Controller\Plugin\MenuData();
				$plugin->setServiceManager($sm->getServiceLocator());
				return $plugin;
			},
		),
	],

	'service_manager' => [
		'aliases' => [
			'MenuService'				=> Service\MenuService::class,
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

		'factories' => array(
			'menu' => function($sm) {
				$menu = new View\Helper\MenuHelper();
				$menu->setServiceManager($sm->getServiceLocator());
				return $menu;
			},
		),

		/*'factories' => [
            'menu' => View\Helper\Factory\MenuFactoryHelper::class,
        ],*/
	],

	'view_manager' => array(
		'template_map' => array(
			'left-menu'               => __DIR__ . '/../view/template/left-menu.phtml',
		),
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),

	'doctrine' => array(
		'eventmanager' => array(
			'orm_default' => array(
				'subscribers' => array(
					// pick any listeners you need
					'Gedmo\Tree\TreeListener',
					'Gedmo\Timestampable\TimestampableListener',
					'Gedmo\Sluggable\SluggableListener',
					'Gedmo\Loggable\LoggableListener',
					'Gedmo\Sortable\SortableListener',
					'Gedmo\Translatable\TranslatableListener',
				),
			),
		),
		'driver' => array(
			//'my_driver' => array(
			__NAMESPACE__ . '_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				//'paths' => array(__DIR__ . '/../src/MyModule/Entity')
				'paths' => [__DIR__ . '/../src/Model']
			),
			'translatable_metadata_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(
					'vendor/gedmo/doctrine-extensions/lib/Gedmo/Translatable/Entity',
				),
			),
			'orm_default' => array(
				'drivers' => array(
					//'MyModule\Entity' => 'my_driver'
					__NAMESPACE__ . '\Model' => __NAMESPACE__ . '_driver',
					'Gedmo\Translatable\Entity' => 'translatable_metadata_driver',
				),
			),
		),
	),
);
