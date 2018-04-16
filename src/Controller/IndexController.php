<?php
namespace Stagem\ZfcMenu\Controller;

use Zend\Stdlib\Exception;
use Zend\View\Model\JsonModel;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\Console\Tests\Command\HelpCommandTest;
use Zend\Mvc\Controller\AbstractActionController;
use Stagem\ZfcMenu\Model\Category;
use Zend\View\Helper\ViewModel;
use Zend\Config\Reader\Json AS ConfigReaderJson;
use Zend\Config\Config;
use Zend\Config\Writer\Json AS ConfigWriterJson;
use Agere\Core\Service\ServiceManagerAwareTrait;

/**
 * @method \Stagem\ZfcMenu\Controller\Plugin\MenuData menuData()
 */
class IndexController extends AbstractActionController
{

    use ServiceManagerAwareTrait;
    /**
     * Documentation to usage
     * https://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/tree.md#basic-usage-examples
*/
    public function indexAction()  //для повернення меню в початковий стан (на хмарі) розкоментувати та запустити даний метод
    {
        $sm = $this->getServiceLocator();
        $om = $sm->get('Doctrine\ORM\EntityManager');

       /* $ourEmployees = new Category();
        $ourEmployees->setTitle('Наши сотрудники');
        $ourEmployees->setUrl('staff/index');

        $callCenter = new Category();
        $callCenter->setTitle('Колл центр');
        $callCenter->setUrl('call-center/index');

        $promProducts = new Category();
        $promProducts->setTitle('Рекламная продукция');
        $promProducts->setUrl('shop-promotional-products/index');

        $shopSpares = new Category();
        $shopSpares->setTitle('Магазин запчастей');
        $shopSpares->setUrl('shop-spares/index');

        $orders = new Category();
        $orders->setTitle('Приказы и распоряжения');
        $orders->setUrl('documents/index');

        $warranty = new Category();
        $warranty->setTitle('Гарантия и сервис');
        $warranty->setUrl('warranty/index');

        $logistics = new Category();
        $logistics->setTitle('Логистика');
        $logistics->setUrl('logistics/orders');

        $softLoans = new Category();
        $softLoans->setTitle('Льготное кредитование');
        $softLoans->setUrl('soft-loans/index');

        $settingsMain = new Category();
        $settingsMain->setTitle('Настройки');
        $settingsMain->setUrl('settings/index');

        $spareAuto = new Category();
        $spareAuto->setTitle('РосАвтоЗапчасть');
        $spareAuto->setUrl('spare/index');

        $discount_n = new Category();
        $discount_n->setTitle('Программа лояльности');
        $discount_n->setUrl('discount/index');

        $updatePrice = new Category();
        $updatePrice->setTitle('Актуализировать цени');
        $updatePrice->setUrl('/store/update-price-list');
        $updatePrice->setParent($settingsMain);

        $usersMonitoring = new Category();
        $usersMonitoring->setTitle('Мониторинг пользователей');
        $usersMonitoring->setUrl('/users/monitoring');
        $usersMonitoring->setParent($settingsMain);

        $rosAuto = new Category();
        $rosAuto->setTitle('РосАвтоЗапчасть');
        $rosAuto->setUrl('/spare/index');
        $rosAuto->setParent($settingsMain);

        $discount = new Category();
        $discount->setTitle('Программа лояльности');
        $discount->setUrl('/discount/index');
        $discount->setParent($settingsMain);

        $systemSettings = new Category();
        $systemSettings->setTitle('Настройки системы');
        $systemSettings->setUrl('');
        $systemSettings->setParent($settingsMain);

        $mail = new Category();
        $mail->setTitle('Письма');
        $mail->setUrl('/mail/index');
        $mail->setParent($systemSettings);

        $roles = new Category();
        $roles->setTitle('Роли');
        $roles->setUrl('/roles/index');
        $roles->setParent($systemSettings);

        $users = new Category();
        $users->setTitle('Управление пользователем');
        $users->setUrl('/users/index');
        $users->setParent($systemSettings);

        $jobTitles = new Category();
        $jobTitles->setTitle('Должности');
        $jobTitles->setUrl('/job-titles/index');
        $jobTitles->setParent($systemSettings);

        $personalData = new Category();
        $personalData->setTitle('Личные данные');
        $personalData->setUrl('/users/change-password');
        $personalData->setParent($systemSettings);

        $status = new Category();
        $status->setTitle('Статусы');
        $status->setUrl('/status/index');
        $status->setParent($systemSettings);

        $editMenu = new Category();
        $editMenu->setTitle('Редактирование меню');
        $editMenu->setUrl('/menu/menu');
        $editMenu->setParent($systemSettings);

        $cars = new Category();
        $cars->setTitle('Автомобили');
        $cars->setUrl('');
        $cars->setParent($settingsMain);

        $brand = new Category();
        $brand->setTitle('Марки машин');
        $brand->setUrl('/brand/index');
        $brand->setParent($cars);

        $carModel = new Category();
        $carModel->setTitle('Модели');
        $carModel->setUrl('/car-model/index');
        $carModel->setParent($cars);

        $carSubgroup = new Category();
        $carSubgroup->setTitle('Подгрупы авто');
        $carSubgroup->setUrl('/car-subgroup/index');
        $carSubgroup->setParent($cars);

        $carEquipment = new Category();
        $carEquipment->setTitle('Комплектации');
        $carEquipment->setUrl('/car-equipment/index');
        $carEquipment->setParent($cars);

        $carAssembly = new Category();
        $carAssembly->setTitle('Сборка авто');
        $carAssembly->setUrl('/car-assembly/index');
        $carAssembly->setParent($cars);

        $supplier = new Category();
        $supplier->setTitle('Поставщики');
        $supplier->setUrl('/supplier/index');
        $supplier->setParent($settingsMain);

        $raSupplier = new Category();
        $raSupplier->setTitle('Поставщики РАЗ');
        $raSupplier->setUrl('/ra-supplier/index');
        $raSupplier->setParent($settingsMain);

        $traffic = new Category();
        $traffic->setTitle('Перевозки');
        $traffic->setUrl('');
        $traffic->setParent($settingsMain);

        $autocarts = new Category();
        $autocarts->setTitle('Автовозы');
        $autocarts->setUrl('/autocarts/index');
        $autocarts->setParent($traffic);

        $autocartsForwarder = new Category();
        $autocartsForwarder->setTitle('Экспедиторы');
        $autocartsForwarder->setUrl('/autocarts-forwarder/index');
        $autocartsForwarder->setParent($traffic);

        $typeAutocarts = new Category();
        $typeAutocarts->setTitle('Типы перевозок');
        $typeAutocarts->setUrl('/type-autocarts/index');
        $typeAutocarts->setParent($traffic);

        $clients = new Category();
        $clients->setTitle('Клиенты');
        $clients->setUrl('');
        $clients->setParent($settingsMain);

        $buyers = new Category();
        $buyers->setTitle('Покупатели');
        $buyers->setUrl('/buyers/index');
        $buyers->setParent($clients);

        $authorizedPersons = new Category();
        $authorizedPersons->setTitle('Уполномоченые лица');
        $authorizedPersons->setUrl('/authorized-persons/index');
        $authorizedPersons->setParent($clients);

        $optionalEquipment = new Category();
        $optionalEquipment->setTitle('Дополнительное оборудование и аксессуары');
        $optionalEquipment->setUrl('/optional-equipment/index');
        $optionalEquipment->setParent($settingsMain);

        $office = new Category();
        $office->setTitle('Отделения');
        $office->setUrl('');
        $office->setParent($settingsMain);

        $regions = new Category();
        $regions->setTitle('Области');
        $regions->setUrl('/regions/index');
        $regions->setParent($office);

        $towns = new Category();
        $towns->setTitle('Города');
        $towns->setUrl('/towns/index');
        $towns->setParent($office);

        $city = new Category();
        $city->setTitle('Склады-продаж');
        $city->setUrl('/city/index');
        $city->setParent($office);

        $dealerships = new Category();
        $dealerships->setTitle('Дилерские центры');
        $dealerships->setUrl('/dealerships/index');
        $dealerships->setParent($office);

        $department = new Category();
        $department->setTitle('Отдел');
        $department->setUrl('/department/index');
        $department->setParent($office);

        $typeBuy = new Category();
        $typeBuy->setTitle('Способ покупки');
        $typeBuy->setUrl('');
        $typeBuy->setParent($settingsMain);

        $vidyOplat = new Category();
        $vidyOplat->setTitle('Виды оплат');
        $vidyOplat->setUrl('/vidy-oplat/index');
        $vidyOplat->setParent($typeBuy);

        $vidyLizinga = new Category();
        $vidyLizinga->setTitle('Виды лизинга');
        $vidyLizinga->setUrl('/vidy-lizinga/index');
        $vidyLizinga->setParent($typeBuy);

        $vidyKreditov = new Category();
        $vidyKreditov->setTitle('Виды кредитов');
        $vidyKreditov->setUrl('/vidy-kreditov/index');
        $vidyKreditov->setParent($typeBuy);

        $vidyRassrochek = new Category();
        $vidyRassrochek->setTitle('Виды рассрочек');
        $vidyRassrochek->setUrl('/vidy-rassrochek/index');
        $vidyRassrochek->setParent($typeBuy);

        $carAction = new Category();
        $carAction->setTitle('Акции');
        $carAction->setUrl('/car-action/index');
        $carAction->setParent($typeBuy);

        $ordersAndInstractions = new Category();
        $ordersAndInstractions->setTitle('Приказы и распоряжения');
        $ordersAndInstractions->setUrl('');
        $ordersAndInstractions->setParent($settingsMain);

        $category = new Category();
        $category->setTitle('Разделы в приказах и распоряжениях');
        $category->setUrl('/category/index');
        $category->setParent($ordersAndInstractions);

        $crm = new Category();
        $crm->setTitle('CRM');
        $crm->setUrl('');
        $crm->setParent($settingsMain);

        $customerResponse = new Category();
        $customerResponse->setTitle('Ответ клиента');
        $customerResponse->setUrl('/customer-response/index');
        $customerResponse->setParent($crm);

        $spares = new Category();
        $spares->setTitle('Запчасти');
        $spares->setUrl('/spares/index');
        $spares->setParent($settingsMain);

        $promotionalProd = new Category();
        $promotionalProd->setTitle('Рекламная продукция');
        $promotionalProd->setUrl('/promotional-products/index');
        $promotionalProd->setParent($settingsMain);

        $om->persist($ourEmployees);
        $om->persist($callCenter);
        $om->persist($promProducts);
        $om->persist($shopSpares);
        $om->persist($orders);
        $om->persist($warranty);
        $om->persist($logistics);
        $om->persist($softLoans);
        $om->persist($settingsMain);

        //$om->persist($settings);
        $om->persist($updatePrice);
        $om->persist($usersMonitoring);
        $om->persist($rosAuto);
        $om->persist($discount);
        $om->persist($systemSettings);
        $om->persist($mail);
        $om->persist($roles);
        $om->persist($users);
        $om->persist($jobTitles);
        $om->persist($personalData);
        $om->persist($status);
        $om->persist($editMenu);
        $om->persist($cars);
        $om->persist($brand);
        $om->persist($carModel);
        $om->persist($carSubgroup);
        $om->persist($carEquipment);
        $om->persist($carAssembly);
        $om->persist($supplier);
        $om->persist($raSupplier);
        $om->persist($traffic);
        $om->persist($autocarts);
        $om->persist($autocartsForwarder);
        $om->persist($typeAutocarts);
        $om->persist($clients);
        $om->persist($buyers);
        $om->persist($authorizedPersons);
        $om->persist($optionalEquipment);
        $om->persist($office);
        $om->persist($regions);
        $om->persist($towns);
        $om->persist($city);
        $om->persist($dealerships);
        $om->persist($department);
        $om->persist($typeBuy);
        $om->persist($vidyOplat);
        $om->persist($vidyLizinga);
        $om->persist($vidyKreditov);
        $om->persist($vidyRassrochek);
        $om->persist($carAction);
        $om->persist($ordersAndInstractions);
        $om->persist($category);
        $om->persist($crm);
        $om->persist($customerResponse);
        $om->persist($spares);
        $om->persist($promotionalProd);
        $om->persist($spareAuto);
        $om->persist($discount_n);

        $om->flush();
        die(__METHOD__);*/
    }
    public function menuAction() {

        $this->layout('layout/home');
        //$view = (new \Zend\View\Model\ViewModel())->setTerminal(true);

        return [];

    }

    public function menuDataAction()
    {
        $sm = $this->getServiceManager();
        $menuService = $sm->get('MenuService');
        $array = $this->menuData()->dataMenu($menuService);

        return new JsonModel($array);
    }

    public function modifyAction()
    {
        if (!($request = $this->getRequest()) && !$request->isPost()) {
            return [];
        }

        if (!method_exists($this, $method = $request->getPost('oper') . 'Operation')) {
            throw new Exception\RuntimeException(sprintf(
                'Operation "%s" not supported. Use only edit or delete operation', $request->getPost('oper')
            ));
        }

        return $this->{$method}();
    }

    public function addOperation()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $sm = $this->getServiceLocator();
            $om = $sm->get('Doctrine\ORM\EntityManager');
            $repo = $om->getRepository('Stagem\ZfcMenu\Model\Category');
            $menuService = $sm->get('MenuService');

            $new = new Category();
            $new->setTitle($request->getPost('name'));
            $new->setUrl($request->getPost('url'));
            if ($request->getPost('parent_id')) {
                $menu = $menuService->getMenuById($request->getPost('parent_id'));
                $new->setParent($menu[0]);
            }
            $om->persist($new);
            $om->flush();

            return (new JsonModel([
                'message' => 'Item successfully added',
            ]));
        }
        return false;
    }

    public function editOperation() {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $sm = $this->getServiceLocator();
            $om = $sm->get('Doctrine\ORM\EntityManager');
            $repo = $om->getRepository('Stagem\ZfcMenu\Model\Category');
            $menuService = $sm->get('MenuService');

            $menu = $menuService->getMenuById($request->getPost('id'));
            $menu[0]->setUrl($request->getPost('url'));
            $menu[0]->setTitle($request->getPost('name'));

            $om->flush();
            return (new JsonModel([
              'message' => 'Item successfully edited',
            ]));
        }
        return false;
    }

    public function delOperation() {
        $request = $this->getRequest();
        if ($request->isPost()) {
        $sm = $this->getServiceLocator();
        $om = $sm->get('Doctrine\ORM\EntityManager');
        $repo = $om->getRepository('Stagem\ZfcMenu\Model\Category');
        $menuService = $sm->get('MenuService');

        $menu = $menuService->getMenuById($request->getPost('id'));
        $menuChild = $menuService->getMenuByParentId($request->getPost('id'));

        foreach ($menuChild as $item){
            $this->menuData()->deleteMenu($item);
            $repo->removeFromTree($item);
        }
        if ($menu[0]) {
            $repo->removeFromTree($menu[0]);
        }
        $om->clear();
        $om->flush();
            return (new JsonModel([
                'message' => 'Item successfully deleted',
            ]));
        }
        return false;
    }

    public function testAction()
    {
        $sm = $this->getServiceLocator();
        $om = $sm->get('Doctrine\ORM\EntityManager');
        $repo = $om->getRepository('Stagem\ZfcMenu\Model\Category');
        /*$carrots = $repo->findOneByTitle('test');
        $repo->moveUp($carrots, true);
        die(__METHOD__);*/
    }
}
