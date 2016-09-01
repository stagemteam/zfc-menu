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

    /*public function menu() {
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $menu = $menuService->getMenu();
        foreach ($menu as $page) {
            printf('<li><a href="/%s">%s <span class="caret"></span></a><ul><li><a href="/patient">Пациенты</a></li></ul></li>', $page->getUrl(), $page->getTitle());
        }
    }*/

    public function menu()
    {
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $menu = $menuService->getMenu();
        foreach ($menu as $page) {
            $children = $menuService->getChildren($page);
            $class = "";
            if (!$children) {
                if ($page->getParent()) {
                    continue;
                }
                printf(
                    '<li class="">' . "\n",
                    ($class ? ' ' . $class : '')
                );
                printf(
                    '<a href="/%s">%s</a>' . "\n",
                    $page->getUrl(),
                    $page->getTitle()
                );
            } else {
                printf(
                    '<li class="dropdown%s">' . "\n",
                    ($class ? ' ' . $class : '')
                );
                printf(
                    '<a href="/" class="sidenav-dropdown-toggle">%s<b class="caret"></b></a>' . "\n",
                    $page->getTitle()
                );
                echo '<ul class="sub-menu">' . "\n";
                foreach ($children as $child) {
                    printf('<li><a href="/%s">%s</a></li>', $child->getUrl(), $child->getTitle());
                }
                echo "</ul></li>\n";
            }
        }
    }


    /*public function menu()
    {
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $menu = $menuService->getMenu();
        foreach ($menu as $page) {
            $children = $menuService->getChildren($page);
            $class = "";
            if (!$children) {
                if ($page->getParent()) {
                    continue;
                }
                printf(
                    '<li class="">' . "\n",
                    ($class ? ' ' . $class : '')
                );
                printf(
                    '<a href="/%s">%s</a>' . "\n",
                    $page->getUrl(),
                    $page->getTitle()
                );
            } else {
                printf(
                    '<li class="dropdown%s">' . "\n",
                    ($class ? ' ' . $class : '')
                );
                printf(
                    '<a href="/" class="dropdown-toggle" data-toggle="dropdown">%s<b class="caret"></b></a>' . "\n",
                    $page->getTitle()
                );
                echo '<ul class="dropdown-menu">' . "\n";
                foreach ($children as $child) {
                    printf('<li><a href="/%s">%s</a></li>', $child->getUrl(), $child->getTitle());
                }
                echo "</ul></li>\n";
            }
        }
    }*/
}


