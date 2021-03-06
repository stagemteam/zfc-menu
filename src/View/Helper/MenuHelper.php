<?php
namespace Stagem\ZfcMenu\View\Helper;

use Popov\ZfcCore\Helper\UrlHelper;
use Stagem\ZfcMenu\Service\MenuService;
use Zend\Stdlib\ArrayObject;
use Zend\View\Helper\AbstractHelper;

class MenuHelper extends AbstractHelper
{
    /**
     * @var MenuService
     */
    protected $config;

    /**
     * @var UrlHelper
     */
    protected $urlHelper;

    public function __construct(array $config = [], UrlHelper $urlHelper)
    {
        $this->config = $config;
        $this->urlHelper = $urlHelper;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function render()
    {
        $menu = $this->getMenu();
        $html = '<div class="sidebar">';
        $html .= '<ul>';
        foreach ($menu as $key => $value) {
            $html .= sprintf('<li><span class="%s"></span><a href=%s>%s</a></li>',
                $value['icon-class'],
                $this->urlHelper->generate($value['action']['route'], $value['action']['params']),
                $value['label']);
        }
        $html .= '</ul></div>';

        return $html;

    }

    public function getMenu() {
        $menu = $this->config['menu'];
        $sortedArray = $this->sort($menu, 'sort_order');
        return $this->prepareSection($sortedArray);
    }

    /**
     * @param $sortedArray
     * @return mixed
     * @todo-vlad Реалізувати рекурсивний підхід
     */
    public function prepareSection($sortedArray) {
        foreach ($sortedArray as $key => $value) {
            if ($value['is_visible'] == true) {
                if (isset($value['children'])) {
                    $childArraySort = $this->sort($value['children'], 'sort_order');
                    foreach ($childArraySort as $k => $v) {
                        if ($value['is_visible'] == true) {
                            if (isset($v['children'])) {
                                $childSort = $this->sort($v['children'], 'sort_order');
                                $childArraySort[$k]['children'] = $childSort;
                            }
                        }
                    }
                    $sortedArray[$key]['children'] = $childArraySort;
                }
            }
        }

        return $sortedArray;
    }

    /**
     * @param $menu
     * @param $sortByOption
     * @return array
     */
    public function sort($menu, $sortByOption)
    {
        $sorted = [];
        foreach ($menu as $key => $value) {
            $sorted[$key] = $value[$sortByOption];
        }
        array_multisort($sorted, SORT_ASC, $menu);
        $sortedArray = [];
        foreach ($sorted as $item => $val) {
            $sortedArray[$item] = $menu[$item];
        }
        return $sortedArray;
    }

    public function menuIcon(){
        $menuService = $this->getMenuService();
        $menu = $menuService->getMainMenu();

        $html = '<div class="sidebar">';
        foreach ($menu as $item) {
            $str = strpos($item->getUrl(), "/");
            $controller = substr($item->getUrl(), 0, $str);
            $html .= sprintf(
                '<ul> <li class="' . $controller .'-ic"><a href="/%s">%s</a></ul>',
                $item->getUrl(),
                $item->getTitle()
            );
        }
        $html .= '</div>';

        return $html;
    }

    public function menuList($url)
    {
        $menuService = $this->getMenuService();
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
        $menuService = $this->getMenuService();
        $mainMenu = $menuService->getMenuByUrl($url);

        $nameSubMenu = '';
        if ($mainMenu) {
            $nameSubMenu = $mainMenu[0]->getTitle();
        } else {
            $urlSubMenu = '/' . $url;
            $menuList = $menuService->getRootByUrl($urlSubMenu);
            $root = $menuList[0]->getRoot();
            $id = $root;                                           //�������� root ���� �������� id ��������� ���� (������������)
            $menuByRoot = $menuService->getMenuById($id);
            $nameSubMenu = $menuByRoot[0]->getTitle();
        }
        return $nameSubMenu;
    }

    public function getShowSubMenu($url){
        $menuService = $this->getMenuService();
        $mainMenu = $menuService->getMenuByUrl($url);

        if ($mainMenu) {
            $idMainMenu = $mainMenu[0];
        } else {
            $urlSubMenu = '/' . $url;
            $menuList = $menuService->getRootByUrl($urlSubMenu);
            $root = $menuList[0]->getRoot();
            $id = $root;                                           //�������� root ���� �������� id ��������� ���� (������������)
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
