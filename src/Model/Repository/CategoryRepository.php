<?php

namespace Stagem\ZfcMenu\Model\Repository;

use \Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Gedmo\Tree\Traits\Repository\ORM\NestedTreeRepositoryTrait;

class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    use NestedTreeRepositoryTrait; // or MaterializedPathRepositoryTrait or ClosureTreeRepositoryTrait.

    public function __construct(EntityManager $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->initializeTreeRepository($em, $class);
    }
}