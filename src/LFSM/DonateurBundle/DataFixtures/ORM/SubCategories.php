<?php
 
namespace John\SiteBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use John\SiteBundle\Entity\SubCategory;
 
class SubCategories implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
      $categoryFilmMusique = $manager->getRepository('JohnSiteBundle:Category')->findOneBySlug('musiques-films');
      
      $subCategory1 = new SubCategory();
      $subCategory1->setTitle('Films');
      $subCategory1->setCategory($categoryFilmMusique);
      $subCategory1->setPicture('films.jpg');
      
      $subCategory2 = new SubCategory();
      $subCategory2->setTitle('Musiques');
      $subCategory2->setCategory($categoryFilmMusique);
      $subCategory2->setPicture('musique.jpg');
 
      // On la persiste
      $manager->persist($subCategory1);
      $manager->persist($subCategory2);
 
    // On déclenche l'enregistrement
    $manager->flush();
  }
}