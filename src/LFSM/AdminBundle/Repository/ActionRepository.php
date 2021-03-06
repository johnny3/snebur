<?php

namespace LFSM\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ActionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActionRepository extends EntityRepository {

    public function myFindAllQuery()
    {
        $queryBuilder = $this->createQueryBuilder('q')
                ->leftJoin('q.theme', 't')
                ->addSelect('t')
                ->orderBy('q.act_lib');

        $query = $queryBuilder->getQuery();

        return $query;
    }
    
    public function myFindAllQuerybuilder()
    {
        $queryBuilder = $this->createQueryBuilder('q')
                ->orderBy('q.act_lib');

        return $queryBuilder;
    }

}
