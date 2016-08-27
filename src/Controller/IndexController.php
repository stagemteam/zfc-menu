<?php
namespace Agere\Menu\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Agere\Menu\Model\Category;

class IndexController extends AbstractActionController
{

    /*public $menu = [
        'Главная' => 'index',
        'Пациенты' => 'patient',
        'Сотрудники' => 'index',
        'Коммуникатор' => 'index',
        'График врачей' => 'index',
        'Учёт материалов' => [
            'Материалы' => 'material',
            'Тип материала' => 'type-material',
            'Категория материала' => 'material-category',
        ]
    ];*/


    /**
     * Documentation to usage
     * https://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/tree.md#basic-usage-examples
     */
    public function indexAction()
    {
        die(__METHOD__);

        $sm = $this->getServiceLocator();
        $om = $sm->get('Doctrine\ORM\EntityManager');

        /*foreach (array_keys($this->menu) as $item) {
            if (!is_array($this->menu[$item])) {
                $temp = new Category();
                $temp->setTitle($item);
                $temp->setUrl($this->menu[$item]);
            } else {
                $temp = new Category();
                $temp->setTitle($item);
                foreach ($this->menu[$item] as $x) {

                }
            }
        }*/

        $index = new Category();
        $index->setTitle('Главная');
        $index->setUrl('');

        $patient = new Category();
        $patient->setTitle('Пациенты');
        $patient->setUrl('patient');

        $employee = new Category();
        $employee->setTitle('Сотрудники');
        $employee->setUrl('user');

        $communicator = new Category();
        $communicator->setTitle('Коммуникатор');
        $communicator->setUrl('');

        $doctor = new Category();
        $doctor->setTitle('График врачей');
        $doctor->setUrl('');

        $accMaterials = new Category();
        $accMaterials->setTitle('Учет материалов');

        $material = new Category();
        $material->setTitle('Материалы');
        $material->setUrl('material');
        $material->setParent($accMaterials);

        $typeMaterial = new Category();
        $typeMaterial->setTitle('Тип материала');
        $typeMaterial->setUrl('type-material');
        $typeMaterial->setParent($accMaterials);

        $materialCategory = new Category();
        $materialCategory->setTitle('Категория материала');
        $materialCategory->setUrl('material-category');
        $materialCategory->setParent($accMaterials);

        $service = new Category();
        $service->setTitle('Сервисы');

        $serviceName = new Category();
        $serviceName->setTitle('Список сервисов');
        $serviceName->setUrl('service');
        $serviceName->setParent($service);

        $serviceCategory = new Category();
        $serviceCategory->setTitle('Категории сервисов');
        $serviceCategory->setUrl('service-category');
        $serviceCategory->setParent($service);

        $setting = new Category();
        $setting->setTitle('Настройки');

        $role = new Category();
        $role->setTitle('Роли');
        $role->setUrl('role');
        $role->setParent($setting);

        $status = new Category();
        $status->setTitle('Управление статусами');
        $status->setUrl('status');
        $status->setParent($setting);

        $om->persist($index);
        $om->persist($patient);
        $om->persist($employee);
        $om->persist($communicator);
        $om->persist($doctor);
        $om->persist($accMaterials);
        $om->persist($material);
        $om->persist($typeMaterial);
        $om->persist($materialCategory);
        $om->persist($status);
        $om->persist($service);
        $om->persist($serviceCategory);
        $om->persist($setting);
        $om->persist($serviceName);
        $om->persist($role);

        $om->flush();

        die(__METHOD__);
    }

    public function testAction() {

        $sm = $this->getServiceLocator();
        $om = $sm->get('Doctrine\ORM\EntityManager');
        $repo = $om->getRepository('Agere\Menu\Model\Category');

        /**
         * Retrieving the whole tree as an array
         */
        /*$arrayTree = $repo->childrenHierarchy(); // зайві накладні витрати якщо буде велике меню
        foreach ($arrayTree as $item) {
            \Zend\Debug\Debug::dump($item);
        }
        die();
        \Zend\Debug\Debug::dump($arrayTree); die();*/

        /**
         * Retrieving as html tree
         */
        $htmlTree = $repo->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* false: load all children, true: only direct */
            array(
                'decorate' => true,
                'representationField' => 'slug',
                'html' => true
            )
        );

         //echo $htmlTree; die();

        /**
         * Customize html tree output
         */
        $repo = $om->getRepository('Agere\Menu\Model\Category');
        $options = array(
            'decorate' => true,
            'rootOpen' => '<ul>',
            'rootClose' => '</ul>',
            'childOpen' => '<li>',
            'childClose' => '</li>',
            'nodeDecorator' => function($node) {
                return '<a href="/'.$node['url'].'">'.$node['title'].'</a>';
            }
        );
        $htmlTree = $repo->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* false: load all children, true: only direct */
            $options
        );

        //echo $htmlTree; die();

        /**
         * Generate your own node list
         */
        $query = $om
            ->createQueryBuilder()
            ->select('node')
            ->from('Agere\Menu\Model\Category', 'node')
            ->orderBy('node.root, node.lft', 'ASC')
            ->where('node.level = 0')
            ->getQuery()
        ;
        $options = array('decorate' => true);
        $tree = $repo->buildTree($query->getArrayResult(), $options);

        //echo $tree; die();


        /**
         * Move Down (Опустити в самий низ)
         */
     //   $repo->moveDown($test, true);


        /**
         * Move Up (Підняти на одну позицію)
         */
       // $repo->moveUp($test, 1);

        /**
         * Find One By Title
         */
        $food = $repo->findOneByTitle('Учет материалов');
        $test = new Category();
        $test->setTitle('Test');
        $test->setUrl('test');
        $test->setParent($food);
        $om->persist($test);
        $om->flush();
        //$repo->moveDown($food, true);

        $children = $repo->children($food);

        //\Zend\Debug\Debug::dump(count($children)); die();
        // \Zend\Debug\Debug::dump(($food->getTitle())); die();
        //echo $repo->childCount($food);
        // prints: 3
        //echo $repo->childCount($food, true/*direct*/);
        // prints: 2
        $carrots = $repo->findOneByTitle('Carrots');
        $test = new Category();
        $test->setTitle('Test');
        $test->setParent($carrots);
        // move it up by one position
        // $children contains:
        // 3 nodes
        $children = $repo->children($food, false, 'title');
        // will sort the children by title
        //$carrots = $repo->findOneByTitle('Carrots');
        $path = $repo->getPath($carrots);

        /* $path contains:
           0 => Food
           1 => Vegetables
           2 => Carrots
        */

        // verification and recovery of tree
        //$repo->verify();
        // can return TRUE if tree is valid, or array of errors found on tree
        //$repo->recover();
        //$om->flush(); // important: flush recovered nodes
        // if tree has errors it will try to fix all tree nodes

        // UNSAFE: be sure to backup before running this method when necessary, if you can use $em->remove($node);
        // which would cascade to children
        // single node removal
        //$vegies = $repo->findOneByTitle('Vegetables');
        //$repo->removeFromTree($vegies);
        //$om->clear(); // clear cached nodes
        // it will remove this node from tree and reparent all children

        // reordering the tree
        //$food = $repo->findOneByTitle('Food');
        //$repo->reorder($food, 'title');
        // it will reorder all "Food" tree node left-right values by the title
        die();
    }
}
