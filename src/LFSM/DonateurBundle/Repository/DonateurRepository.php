<?php

namespace LFSM\DonateurBundle\Repository;

use Doctrine\ORM\EntityRepository;
use LFSM\DonateurBundle\Entity\Donateur;

/**
 * DonateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DonateurRepository extends EntityRepository {

    public function getDonateursByEtatStatutQueryBuilder($orderBy = null)
    {
        $queryBuilder = $this->createQueryBuilder('d')
                ->leftJoin('d.etat', 'e')
                ->addSelect('e')
                ->leftJoin('d.statut', 's')
                ->addSelect('s');
        
        if ($orderBy){
            $queryBuilder ->orderBy($orderBy);
        }

        return $queryBuilder;
    }
    public function getDonateursByEtatStatutQuery($orderBy = null)
    {
        return $this->getDonateursByEtatStatutQueryBuilder($orderBy)->getQuery();
    }

    public function getDonateursByParameters($em, $dataArray, $sort = null)
    {
        unset($dataArray['_token']);

        $queryBuilder = $this->getDonateursByEtatStatutQueryBuilder();
        $b_anneeFideliteCriteria = false;
        
        foreach($dataArray as $key=>$data){
           if ('birthday' == $key){
               $postDate = $data['year'] . '-' . $data['month'] . '-' . $data['day'];
               if ('--' !== $postDate){
                    $queryBuilder->andWhere(sprintf('d.%s=:%s', $key, $key))
                            ->setParameter($key, date('Y-m-d', strtotime($postDate)));
               }
           }
           elseif ('nombreEnfants' == $key && '' != $data){
               if ('plus' != $data){
                   $queryBuilder->andWhere(sprintf('d.%s=:%s', $key, $key));
               }
               else{
                   $data = 3;
                   $queryBuilder->andWhere(sprintf('d.%s>:%s', $key, $key));
               }
               
               $queryBuilder->setParameter($key, $data);
           }
           elseif ('hasPhoneNumber' == $key && $data){
               $queryBuilder->andWhere($queryBuilder->expr()->orX(
                                            $queryBuilder->expr()->isNotNull('d.telPrm'),
                                            $queryBuilder->expr()->isNotNull('d.telSec'),
                                            $queryBuilder->expr()->isNotNull('d.telPtb')
                ));
           }
           elseif ('hasEmail' == $key && $data){
               $queryBuilder->andWhere('d.email IS NOT NULL');
           }
           elseif (in_array($key, array('modeDePaiement', 'nbAnneesFidelite'))){
              if(false == strpos($queryBuilder->getDQL(), 'LEFT JOIN d.dons dons')){
                  $queryBuilder->leftJoin('d.dons', 'dons')
                            ->addSelect('dons');
              }
              
              if ('modeDePaiement' == $key && $data){
                    $mdpTab = explode('-', $data);
                    $queryBuilder->add('where', $queryBuilder->expr()->in('dons.mdp', $mdpTab));
              }
              
              if ('nbAnneesFidelite' == $key && $data){
                  $b_anneeFideliteCriteria = true;
                  $i_baseAnneesFidelite = $data;
                  $a_dates_annees = array();
                  
                  if (preg_match('/^[0-9]{4} et plus$/', $i_baseAnneesFidelite)){
                    $a_anneeCriteriaArray = explode(' et plus', $i_baseAnneesFidelite);
                    $i_anneeCriteria = $a_anneeCriteriaArray[0];
                    $i_baseAnneesFidelite = $i_anneeCriteria - 1;
                  }
                  
                  for ($i = $i_baseAnneesFidelite; $i <= date('Y'); $i++){
                    $a_dates_annees[] = $i;
                  }
                  
                  $queryBuilder->andWhere('YEAR(dons.dateDon) IN (:a_dates_annees)')
                        ->setParameter('a_dates_annees', $a_dates_annees);
              }
           }
           else {
               if (isset($key) && !empty($data)) {
                    $queryBuilder->andWhere(sprintf('d.%s=:%s', $key, $key))
                            ->setParameter($key, $data);
               }
           } 
        }
        
        if (null !== $sort) {
            $queryBuilder->orderBy($sort['sort'], $sort['direction']);
        } else {
            $sort['sort'] = 'd.nom';
            $queryBuilder->orderBy($sort['sort']);
        }
        
        $a_results = $queryBuilder->getQuery()->getResult();
        
        if ($b_anneeFideliteCriteria){
            foreach ($a_results as $indexDonateur => $o_donateur){
                for ($i = $i_baseAnneesFidelite; $i <= date('Y'); $i++){
                    $b_hasDonatedForThisYear = $em->getRepository('LFSMDonateurBundle:Don')->hasDonatedThisYear($o_donateur->getId(), (int)$i);
                    
                    if (!$b_hasDonatedForThisYear){
                        unset($a_results[$indexDonateur]);
                        continue;
                    }
                }
            }
        }
        
        return $a_results;
    }

    public function getDonateursByEtatIndiceTPromesseList($dataArray)
    {
        $queryBuilder = $this->getDonateursByEtatStatutQueryBuilder()
                ->leftJoin('d.civilite', 'c')
                ->addSelect('c')
                ->leftJoin('d.fonction', 'f')
                ->addSelect('f');
        
        if (!empty($dataArray)) {
            if (isset($dataArray['indice_t'])) {
                $queryBuilder->andWhere('d.indice_t=:indice_t')
                        ->setParameter('indice_t', true);
            }

            if (isset($dataArray['promesse'])) {
                $queryBuilder->andWhere('d.promesse=:promesse')
                        ->setParameter('promesse', true);
            }

            if (isset($dataArray['etat'])) {
                    $etatTab = explode('-', $dataArray['etat']);

                    $queryBuilder->andWhere('d.etat IN (:etat_id)')
                        ->setParameter('etat_id', $etatTab);
            }

            $sort = 'd.nom';
            $direction = 'asc';

            if (isset($dataArray['sort']) && isset($dataArray['direction'])) {
                $sort = $dataArray['sort'];
                $direction = $dataArray['direction'];
            }
            $queryBuilder->orderBy($sort, $direction);
        }

        return $queryBuilder->getQuery()->getResult();
    }
    
    
    
    public function getDonateursByAgeAndLastDon($dataArray) {
        $queryBuilder = $this->createQueryBuilder('d');

        if (!empty($dataArray)) {
            if (isset($dataArray['ageMin']) && isset($dataArray['ageMax']) && isset($dataArray['anneeDebut']) && isset($dataArray['anneeFin'])
            ) {
                $ageMin = $dataArray['ageMin'];
                $ageMax = $dataArray['ageMax'];
                $anneeDebut = $dataArray['anneeDebut'];
                $anneeFin = $dataArray['anneeFin'];

                if ('' != $ageMin && '' == $ageMax) {
                    $dateTimeAgeMin = new \DateTime('-' . $ageMin . ' year');
                    $dateAgeMin = $dateTimeAgeMin->format('Y-m-d');
                    $queryBuilder->andWhere('d.birthday <= :anneeNaissanceAgeMin')
                            ->setParameter('anneeNaissanceAgeMin', $dateAgeMin);
                } elseif ('' == $ageMin && '' != $ageMax) {
                    $dateTimeAgeMax = new \DateTime('-' . $ageMax . ' year');
                    $dateAgeMax = $dateTimeAgeMax->format('Y-m-d');
                    $queryBuilder->andWhere('d.birthday >= :anneeAgeMax')
                            ->setParameter('anneeAgeMax', $dateAgeMax);
                } elseif ('' != $ageMin && '' != $ageMax) {
                    $dateTimeAgeMin = new \DateTime('-' . $ageMin . ' year');
                    $dateAgeMin = $dateTimeAgeMin->format('Y-m-d');
                    $dateTimeAgeMax = new \DateTime('-' . $ageMax . ' year');
                    $dateAgeMax = $dateTimeAgeMax->format('Y-m-d');
                    $queryBuilder->andWhere('d.birthday >= :anneeAgeMax')
                            ->setParameter('anneeAgeMax', $dateAgeMax)
                            ->andWhere('d.birthday <= :anneeNaissanceAgeMin')
                            ->setParameter('anneeNaissanceAgeMin', $dateAgeMin);
                }

                if ('' != $anneeDebut && '' == $anneeFin) {
                    $queryBuilder->andWhere('d.dateDernierDon >= :anneeDebut')
                            ->setParameter('anneeDebut', $anneeDebut)
                            ->andWhere('d.dateDernierDon IS NOT NULL');
                } elseif ('' == $anneeDebut && '' != $anneeFin) {
                    $queryBuilder->andWhere('d.dateDernierDon <= :anneeFin')
                            ->setParameter('anneeFin', $anneeFin)
                            ->andWhere('d.dateDernierDon IS NOT NULL');
                } elseif ('' != $anneeDebut && '' != $anneeFin) {
                    $queryBuilder->andWhere('d.dateDernierDon >= :anneeDebut')
                            ->setParameter('anneeDebut', $anneeDebut)
                            ->andWhere('d.dateDernierDon <= :anneeFin')
                            ->setParameter('anneeFin', $anneeFin)
                            ->andWhere('d.dateDernierDon IS NOT NULL');
                }
            }

            $sort = 'd.nom';
            $direction = 'asc';

            if (isset($dataArray['sort']) && isset($dataArray['direction'])) {
                $sort = $dataArray['sort'];
                $direction = $dataArray['direction'];
            }
            $queryBuilder->orderBy($sort, $direction);
        }

        $query = $queryBuilder->getQuery()->getResult();

        return $query;
    }

    public function dateDifference($date)  
    {
        $s = strtotime($date)-strtotime(date('Y-m-d'));
        $d = intval($s/86400);  
        return $d;
    } 

}
