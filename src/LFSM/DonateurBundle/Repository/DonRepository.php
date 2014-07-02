<?php

namespace LFSM\DonateurBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * DonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DonRepository extends EntityRepository {

    public function getDonsByDonateurQueryBuilder($donateur) {
        $queryBuilder = $this->createQueryBuilder('d')
                ->leftJoin('d.donateur', 'don')
                ->addSelect('don')
                ->andWhere('d.donateur=:donateur')
                ->setParameter('donateur', $donateur)
                ->orderBy('d.dateDon', 'DESC');

        return $queryBuilder;
    }
    
    
    public function getDonsByDonateurAndYear($donateur, $year) {
        $queryBuilder = $this->getDonsByDonateurQueryBuilder($donateur)
                        ->andWhere('YEAR(d.dateDon)=:year')
                        ->setParameter('year', $year);
        
        $results = $queryBuilder->getQuery()->getResult(Query::HYDRATE_OBJECT);
        
        return $results;
    }
    
    
    public function hasDonatedThisYear($donateur, $year){
        $results = $this->getDonsByDonateurAndYear($donateur, $year);
        
        if (empty($results)) {
            return 0;
        }

        return 1;
    }
    
    
    public function getDonsByDonateur($donateur) {
        $queryBuilder = $this->getDonsByDonateurQueryBuilder($donateur);

        $results = $queryBuilder->getQuery()->getResult(Query::HYDRATE_OBJECT);

        return $results;
    }

    public function findByDateAndAmount($dataArray){
        $queryBuilder = $this->createQueryBuilder('d')
                ->leftJoin('d.donateur', 'donateur')
                ->addSelect('donateur');

        if (!empty($dataArray)) {
            $anneeDebut = $dataArray['dateDebut']['year'] . '-' . $dataArray['dateDebut']['month'] . '-' . $dataArray['dateDebut']['day'];
            $anneeFin = $dataArray['dateFin']['year'] . '-' . $dataArray['dateFin']['month'] . '-' . $dataArray['dateFin']['day'];

            $queryBuilder->andWhere('d.dateDon >= :anneeDebut')
                    ->setParameter('anneeDebut', $anneeDebut)
                    ->andWhere('d.dateDon <= :anneeFin')
                    ->setParameter('anneeFin', $anneeFin);
            
            if (isset($dataArray['montantMin']) 
                    && isset($dataArray['montantMin']) 
                    && isset($dataArray['montantMax']) 
                    && isset($dataArray['montantMax'])
            ) {
                $montantMin = $dataArray['montantMin'];
                $montantMax = $dataArray['montantMax'];
                
                if ('' != $montantMin && '' == $montantMax) {
                    $queryBuilder->andWhere('d.montant >= :montantMin')
                            ->setParameter('montantMin', $montantMin);
                } elseif ('' == $montantMin && '' != $montantMax) {
                    $queryBuilder->andWhere('d.montant <= :montantMax')
                            ->setParameter('montantMax', $montantMax);
                } elseif ('' != $montantMin && '' != $montantMax) {
                    $queryBuilder->andWhere('d.montant >= :montantMin')
                            ->setParameter('montantMin', $montantMin)
                            ->andWhere('d.montant <= :montantMax')
                            ->setParameter('montantMax', $montantMax);
                }
            }

            $sort = 'd.dateDon';
            $direction = 'desc';

            if (isset($dataArray['sort']) && isset($dataArray['direction'])) {
                $sort = $dataArray['sort'];
                $direction = $dataArray['direction'];
            }
            $queryBuilder->orderBy($sort, $direction);
        }

        $query = $queryBuilder->getQuery()->getResult();

        return $query;
    }

}
