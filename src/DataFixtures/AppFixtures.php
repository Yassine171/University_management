<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Prof;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
      
      $info=new Filiere();
      $info->setName('Info');
      $manager->persist($info);

      $indus=new Filiere();
      $indus->setName('indus');
      $manager->persist($indus);

         $meca=new Filiere();
      $meca->setName('meca');
      $manager->persist($meca);

      $entreprise=new Entreprise();
      $entreprise->setName('DXC');
     

      $prof=new Prof();
      $prof->setName('BenBrahim');

      for($i=0 ; $i<100 ; $i++) {

        $etudiant=new Etudiant();
        $name=$faker->name;
        $etudiant->setName($name);
        $etudiant->setCv(str_replace(' ', '_', $name).'.pdf');
        $etudiant->setNvScolaire($faker->randomElement($array = array ('1CI','2CI','3CI')));

        $randomFiliere = $faker->randomElement($array = array ('info','meca','indus'));

        $etudiant->setFiliere($$randomFiliere);

        $prof->addEtudiantsEncadre($etudiant);
         $entreprise->addStagiaire($etudiant);
        $manager->persist($etudiant);
       
      }
      //$faker->randomDigit()>7 ? $info : ($faker->randomDigit()>3 ? $meca :$indus


      $entreprise1=new Entreprise();
      $entreprise1->setName('Capgemini');
     

      $prof1=new Prof();
      $prof1->setName('Moumen');

      for($i=0 ; $i<100 ; $i++) {

        $etudiant=new Etudiant();
        $name=$faker->name;
        $etudiant->setName($name);
        $etudiant->setCv(str_replace(' ', '_', $name).'.pdf');
        $etudiant->setNvScolaire($faker->randomElement($array = array ('1CI','2CI','3CI')));
        $randomFiliere = $faker->randomElement($array = array ('info','meca','indus'));

        $etudiant->setFiliere($$randomFiliere);
        $prof->addEtudiantsEncadre($etudiant);
         $entreprise->addStagiaire($etudiant);
        $manager->persist($etudiant);
       
      }

      $manager->persist($prof1);
       $manager->persist($entreprise1);
      $manager->persist($prof);
       $manager->persist($entreprise);
        $manager->flush();
    }
}
