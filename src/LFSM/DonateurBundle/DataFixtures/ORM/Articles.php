<?php

namespace John\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use John\SiteBundle\Entity\Article;

class Articles implements FixtureInterface {

    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
//        $categoryBodhiyuga = $manager->getRepository('JohnSiteBundle:Category')->findOneBySlug('bodhiyuga');
//        $categoryMusiqueFilms = $manager->getRepository('JohnSiteBundle:Category')->findOneBySlug('musiques-films');
//        $categoryMusiques = $manager->getRepository('JohnSiteBundle:SubCategory')->findOneBySlug('musiques');
//        $categoryFilms = $manager->getRepository('JohnSiteBundle:SubCategory')->findOneBySlug('films');
//
//        var_dump($categoryBodhiyuga);die;
//        
//        $article1 = new Article();
//        $article1->setTitle('article 1');
//        $article1->setCategory($categoryBodhiyuga);
//        $article1->setBody('<p>corps article 1</p><p>suite corps article 1</p>');
//
//        $article2 = new Article();
//        $article2->setTitle('article 2');
//        $article2->setCategory($categoryBodhiyuga);
//        $article2->setBody('<p>corps article 2</p><p>suite corps article 2</p>');
//        
//        $article3 = new Article();
//        $article3->setTitle('article 3');
//        $article3->setCategory($categoryMusiqueFilms);
//        $article3->setBody('<p>corps article 3</p><p>suite corps article 3</p>');
//
//        $article4 = new Article();
//        $article4->setTitle('article 4');
//        $article4->setCategory($categoryMusiqueFilms);
//        $article4->setBody('<p>corps article 4</p><p>suite corps article 4</p>');
//        
//        $article5 = new Article();
//        $article5->setTitle('article 5');
//        $article5->setSubCategory($categoryMusiques);
//        $article5->setBody('<p>corps article 5</p><p>suite corps article 5</p>');
//
//        $article6 = new Article();
//        $article6->setTitle('article 6');
//        $article6->setSubCategory($categoryFilms);
//        $article6->setBody('<p>corps article 6</p><p>suite corps article 6</p>');
//
//        // On la persiste
//        $manager->persist($article1);
//        $manager->persist($article2);
//        $manager->persist($article3);
//        $manager->persist($article4);
//        $manager->persist($article5);
//        $manager->persist($article6);
//
//        // On déclenche l'enregistrement
//        $manager->flush();
    }

}