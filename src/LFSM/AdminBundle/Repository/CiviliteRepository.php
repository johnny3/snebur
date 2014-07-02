<?php

namespace LFSM\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CiviliteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CiviliteRepository extends EntityRepository {

    public function myFindAllQuery()
    {
        $queryBuilder = $this->createQueryBuilder('q')
                ->orderBy('q.civ_lib_court');

        $query = $queryBuilder->getQuery();

        return $query;
    }

}