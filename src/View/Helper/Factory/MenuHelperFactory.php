<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2018 Stagem Team
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_ZfcMenu
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\ZfcMenu\View\Helper\Factory;

use Popov\ZfcCore\Helper\UrlHelper;
use Psr\Container\ContainerInterface;
use Stagem\ZfcMenu\View\Helper\MenuHelper;
use Zend\ServiceManager\ServiceManager;

class MenuHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        //$menuService = $container->get('MenuService');
        $config = $container->get('config');
        $urlHelper = $container->get(UrlHelper::class);

        $menuHelper = new MenuHelper($config, $urlHelper);

        return $menuHelper;
    }
}