<?php

namespace LFSM\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * StatutSocialRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatutSocialRepository extends EntityRepository
{
    public function myFindAllQuery()
    {
        $queryBuilder = $this->createQueryBuilder('q')
                ->orderBy('q.statutSocialLibelle');

        $query = $queryBuilder->getQuery();

        return $query;
    }
}
