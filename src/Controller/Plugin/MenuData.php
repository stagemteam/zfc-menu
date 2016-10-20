<?php
/**
 * Created by PhpStorm.
 * User: Specter
 * Date: 17.10.2016
 * Time: 15:58
 */
namespace Agere\Menu\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Agere\Menu\Model\Category;
use Agere\Menu\Controller;
use Agere\Core\Service\ServiceManagerAwareTrait;

class MenuData extends AbstractPlugin
{
    use ServiceManagerAwareTrait;

    public function dataMenu($menuService)
    {
        $array = [
            'rows' => [
            ],
        ];
        foreach ($menuService->getTableMenu() as $item) {
            //\Zend\Debug\Debug::dump($item->getUrl());
            if ($item->getParent() == null) {
                $id = null;
            } else {
                $id = sprintf("%s", $item->getParent()->getId());
            }
            if (count($item->getChildren())) {
                $isLeaf = "false";
            } else {
                $isLeaf = "true";
            }
            $array ['rows'][] = [
                'account_id' => $item->getId(),
                'name' => $item->getTitle(),
                'url' => $item->getUrl(),
                'created' => $item->getCreated()->format('Y-m-d H:i:s'),
                'updated' => $item->getUpdated()->format('Y-m-d H:i:s'),
                'parent_id' => $id,
                'level' => $item->getLevel(),
                'isLeaf' => $isLeaf,
                'loaded' => "true",
                //'expanded' => "true",
            ];
        }

        return $array;
    }

    public function deleteMenu($item)
    {
        $sm = $this->getServiceManager();
        $om = $sm->get('Doctrine\ORM\EntityManager');
        $repo = $om->getRepository('Agere\Menu\Model\Category');
        foreach ($item->getChildren() as $child) {
            if (count($child->getChildren())) {
                $repo->removeFromTree($child);
                foreach ($child->getChildren() as $child2) {
                    if (count($child2->getChildren())) {
                        $repo->removeFromTree($child2);
                        $this->deleteMenu($child);
                    } else {
                        $repo->removeFromTree($child2);
                    }
                }
            } else {
                // $repo->removeFromTree($item);
                $repo->removeFromTree($child);
            }
        }
        //\Zend\Debug\Debug::dump($child); die(__METHOD__);
        // return $child;
    }
}
