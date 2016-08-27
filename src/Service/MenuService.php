<?php
/**
 * Enter description here...
 *
 * @category Agere
 * @package Agere_<package>
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 25.10.13 16:49
 */
namespace Agere\Menu\Service;

use Agere\Core\Service\DomainServiceAbstract;
use Agere\Menu\Model\Category;

class MenuService extends DomainServiceAbstract
{
	protected $entity = Category::class;

	public function getMainMenu()
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Agere\Menu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			->where('node.level = 0')
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function getMenu()
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Agere\Menu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			//->where('node.level = 0')
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function getChildren($page)
	{
		$repository = $this->getRepository();
		$children = $repository->children($page);
		
		return $children;
	}

}