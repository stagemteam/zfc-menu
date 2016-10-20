<?php
namespace Agere\Menu\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Agere\Core\Service\ServiceManagerAwareTrait;
use    Agere\User\Acl\Acl;

class MenuHelper extends AbstractHelper
{
    use ServiceManagerAwareTrait;

    public function mainMenu()
    {
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');

        return $menuService->getMainMenu();
    }

    public function menu()
    {
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $menu = $menuService->getMainMenu();

        echo ('<div class="sidebar">');
        foreach ($menu as $item) {
                $str = strpos($item->getUrl(), "/");
                $controller = substr($item->getUrl(), 0, $str);
                 printf('<div class="main-nav '. $controller .'"><span></span><a href="/%s">%s</a></div>', $item->getUrl(), $item->getTitle());
        }
        printf('</div>');
    }

    public function menuIcon(){
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $menu = $menuService->getMainMenu();

        printf('<div class="sidebar">');
        foreach ($menu as $item) {
            $str = strpos($item->getUrl(), "/");
            $controller = substr($item->getUrl(), 0, $str);
            printf('<ul> <li class="' . $controller .'-ic"><a href="/%s">%s</a></ul>', $item->getUrl(), $item->getTitle());
        }
        printf('</div>');
    }

    public function menuList($url)
    {
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $mainMenu = $menuService->getMenuByUrl($url);

        if ($mainMenu) {
            $root = $mainMenu[0]->getRoot();
        } else {
            $urlSubMenu = '/' . $url;
            $menuList = $menuService->getRootByUrl($urlSubMenu);
            $root = $menuList[0]->getRoot();
            //\Zend\Debug\Debug::dump($root); die(__METHOD__);
        }
        $menu = $menuService->getMenuIdByRoot($root);
        //\Zend\Debug\Debug::dump(recursive()); die();
           printf('<ul class="level-1">');
               foreach ($menu as $item) {
                   $this->recursiveSubMenu($item);
               }
           printf('</ul>');
    }

    public function recursiveSubMenu($item)
    {
        foreach ($item->getChildren() as $child)
        {
            if (count($child->getChildren()))
            {
                printf('<li><a href="#">%s</a>
                            <span class="figure arrow-down"></span>
                            <ul class="level-2">', $child->getTitle());
                foreach ($child->getChildren() as $child2) {
                    if (count($child2->getChildren()) == 0){
                        printf('<li><a href="%s">%s</a></li>', $child2->getUrl(), $child2->getTitle());
                    } else {
                        $this->recursiveSubMenu($child);
                    }
                }
                echo '</ul></li>';
            }
           elseif (count($item->getParent()) == 0) {
                printf('<li><a href="%s">%s</a></li>', $child->getUrl(), $child->getTitle());
            }
        }
    }

    public function getNameSubMenu($url){
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $mainMenu = $menuService->getMenuByUrl($url);

        $nameSubMenu = '';
        if ($mainMenu) {
            $nameSubMenu = $mainMenu[0]->getTitle();
        } else {
            $urlSubMenu = '/' . $url;
            $menuList = $menuService->getRootByUrl($urlSubMenu);
            $root = $menuList[0]->getRoot();
            $id = $root;                                           //значення root рівне значенню id головного меню (батьківського)
            $menuByRoot = $menuService->getMenuById($id);
            $nameSubMenu = $menuByRoot[0]->getTitle();
        }
        return $nameSubMenu;
    }

    public function getShowSubMenu($url){
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $mainMenu = $menuService->getMenuByUrl($url);

        if ($mainMenu) {
            $idMainMenu = $mainMenu[0];
        } else {
            $urlSubMenu = '/' . $url;
            $menuList = $menuService->getRootByUrl($urlSubMenu);
            $root = $menuList[0]->getRoot();
            $id = $root;                                           //значення root рівне значенню id головного меню (батьківського)
            $menuByRoot = $menuService->getMenuById($id);
            $idMainMenu = $menuByRoot[0];
        }



        if (count($idMainMenu->getChildren()))
        {
            $showSubMenu = true;
        } else {
            $showSubMenu = false;
        }
        return $showSubMenu;
    }
}
