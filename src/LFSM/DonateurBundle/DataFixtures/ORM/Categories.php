<?php
 
namespace John\SiteBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use John\SiteBundle\Entity\Category;
 
class Categories implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $titles = array(
        'Dieu' => "neale.jpg", 
        'Bodhiyuga' => "bodhiyuga.jpg",
        'Musiques & Films' => "Musique-Film.jpg",
        'Spiritualité' => "spiritualite.jpg",
        'La vie' => "difficultes-bonmoments.jpg",
        'Citations' => "citations-reflexions.jpg",
        'Histoires' => "histoires.jpg",
        'Lectures' => "lectures.jpg",
        'Ma vie' => "ma-vie.gif",
        );
    
    $textes = array(
        'Dieu' => "<p>Neale Donald Walsch, auteur de \"Conversations avec Dieu\", nous a permis de nous ouvrir à une nouvelle réalité. Aujourd'hui, il publie quotidiennement des lettres que je vous livre en français.</p>", 
        'Bodhiyuga' => "<p>Bodhiyuga, un être en quête perpétuelle d'éveil, et a énormément apporté avant de fermer son site. Je vous livre aujourd'hui une partie de ses lettres.</p>",
        'Musiques & Films' => "<p>Depuis des années, les films et la musique m'aident à m'ouvrir sur le monde, alors voici une sélection de ceux qui m'ont grandement inspirés.</p>",
        'Spiritualité' => "<p>Ma réflexion personnelle sur la spiritualité en règle générale.</p>",
        'La vie' => "<p>Diverses réflexions sur la vie, ses obstacles comme ses joies.</p>",
        'Citations' => "<p>Citations et réflexions de grands hommes qui ont influencé leurs proches... et leurs moins proches...</p>",
        'Histoires' => "<p>Histoires spirituelles, lues sur internet, que je trouve inspirantes.</p>",
        'Lectures' => "<p>Les livres que j'ai lus ces dernières années, ces derniers mois ou ces dernières semaines, qui ont influencé ma vie.</p>",
        'Ma vie' => "<p>Divers événements de ma vie, la plupart spirituels.</p>",
        );
    
    foreach($titles as $key => $value)
    {
      // On crée la catégorie
      $liste_categories[$key] = new Category();
      $liste_categories[$key]->setTitle($key);
      $liste_categories[$key]->setShortText($textes[$key]);
      $liste_categories[$key]->setPicture($value);
 
      // On la persiste
      $manager->persist($liste_categories[$key]);
    }
 
    // On déclenche l'enregistrement
    $manager->flush();
  }
}