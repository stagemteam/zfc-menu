<?php
/**
 * Spare Controller Factory
 *
 * @category Agere
 * @package Agere_Spare
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 04.04.2016 0:19
 */
namespace Stagem\ZfcMenu\Controller\Factory;

use Stagem\ZfcMenu\Controller\IndexController;

class IndexControllerFactory
{
    public function __invoke($cm)
    {
        $sm = $cm->getServiceLocator();
        $controller = new IndexController();
        $controller->setServiceManager($sm);

        return $controller;
    }
}