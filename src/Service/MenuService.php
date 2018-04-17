<?php
/**
 * Enter description here...
 *
 * @category Agere
 * @package Agere_<package>
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 25.10.13 16:49
 */
namespace Stagem\ZfcMenu\Service;

use Popov\ZfcCore\Service\DomainServiceAbstract;
use Stagem\ZfcMenu\Model\Category;

class MenuService extends DomainServiceAbstract
{
	protected $entity = Category::class;

	public function getMainMenu()
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
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
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			->where("node.level > 0")
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function getMenuById($id)
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			->where("node.id = $id")
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function getMenuByParentId($id)
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			->where("node.parent = $id")
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function getMenuByUrl($url)
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			->where("node.url = '$url'")
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function getRootByUrl($urlSubMenu)
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			->where("node.url = '$urlSubMenu'")
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function getMenuIdByRoot($root)
	{
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			->where("node.id = '$root'")
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

	/*public function getSettingsChildren() {
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			//->where('node.level = 0')
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}

	public function get() {
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			//->where('node.level = 0')
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}*/

	public function getTableMenu(){
		$om = $this->getObjectManager();
		$query = $om
			->createQueryBuilder()
			->select('node')
			->from('Stagem\ZfcMenu\Model\Category', 'node')
			->orderBy('node.root, node.lft', 'ASC')
			//->where('node.level')
			->getQuery()
		;
		//return $query->getArrayResult();
		return $query->getResult();
	}
}
