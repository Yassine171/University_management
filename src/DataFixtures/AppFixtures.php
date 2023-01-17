<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Prof;
use App\Entity\User;
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
      $info->setModules(['java','R','php','JavaScript']);

      $indus=new Filiere();
      $indus->setName('indus');
      $manager->persist($indus);
      $indus->setModules(['java','Math','conception','elcrique']);

         $meca=new Filiere();
      $meca->setName('meca');
      $manager->persist($meca);
      $meca->setModules(['mecanique','optique','System embarque']);

      $entreprise=new Entreprise();
      $entreprise->setName('DXC');
        $user=new User();
        $user->setEmail('yassine_entreprise@email.ma');
        $user->setPassword('$2y$13$HrK9evtizVc0ccEH70krfulgmm0BiNLtQVvxteXdHtzQp5S.o1MYW');
        $user->setRoles(['ROLE_ENTREPRISE']);
      $entreprise->setUserId($user);
   
     

      $prof=new Prof();
      $prof->setName('BenBrahim');
      $prof->setModules(['mecanique','optique']);

      $user=new User();
      $user->setEmail('yassine_prof@email.ma');
      $user->setPassword('$2y$13$HrK9evtizVc0ccEH70krfulgmm0BiNLtQVvxteXdHtzQp5S.o1MYW');
      $user->setRoles(['ROLE_ENTREPRISE']);

      $prof->setUserId($user);

      for($i=0 ; $i<10 ; $i++) {

        $etudiant=new Etudiant();
        $name=$faker->name;
        $etudiant->setName($name);
        $etudiant->setCv(str_replace(' ', '_', $name).'.pdf');
        $etudiant->setNvScolaire($faker->randomElement($array = array ('1CI','2CI','3CI')));

        $user=new User();
        $user->setEmail(str_replace(' ', '_', $name).'@email.ma');
        $user->setPassword('$2y$13$HrK9evtizVc0ccEH70krfulgmm0BiNLtQVvxteXdHtzQp5S.o1MYW');
        $user->setRoles(['ROLE_ENTREPRISE']);
  
        $etudiant->setUserId($user);

        $randomFiliere = $faker->randomElement($array = array ('info','meca','indus'));

        $etudiant->setFiliere($$randomFiliere);

        $prof->addEtudiantsEncadre($etudiant);
         $entreprise->addStagiaire($etudiant);
        $manager->persist($etudiant);
       
      }
      //$faker->randomDigit()>7 ? $info : ($faker->randomDigit()>3 ? $meca :$indus


      $entreprise1=new Entreprise();
      $entreprise1->setName('Capgemini');

      $user=new User();
      $user->setEmail('oussi_entreprise@email.ma');
      $user->setPassword('$2y$13$HrK9evtizVc0ccEH70krfulgmm0BiNLtQVvxteXdHtzQp5S.o1MYW');
      $user->setRoles(['ROLE_ENTREPRISE']);
      
      $entreprise1->setUserId($user);
     

      $prof1=new Prof();
      $prof1->setName('Moumen');
      $prof1->setModules(['java','R','Compilation','JavaScript']);
      
      $user=new User();
      $user->setEmail('oussi_prof@email.ma');
      $user->setPassword('$2y$13$HrK9evtizVc0ccEH70krfulgmm0BiNLtQVvxteXdHtzQp5S.o1MYW');
      $user->setRoles(['ROLE_ENTREPRISE']);

      $prof1->setUserId($user);

      for($i=0 ; $i<10 ; $i++) {

        $etudiant=new Etudiant();
        $name=$faker->name;
        $etudiant->setName($name);
        $etudiant->setCv(str_replace(' ', '_', $name).str_replace(' ', '_', $name).'.pdf');
        $etudiant->setNvScolaire($faker->randomElement($array = array ('1CI','2CI','3CI')));
        $randomFiliere = $faker->randomElement($array = array ('info','meca','indus'));

        $etudiant->setFiliere($$randomFiliere);
        $user=new User();
      $user->setEmail(str_replace(' ', '_', $name).'@email.ma');
      $user->setPassword('$2y$13$HrK9evtizVc0ccEH70krfulgmm0BiNLtQVvxteXdHtzQp5S.o1MYW');
      $user->setRoles(['ROLE_ENTREPRISE']);

      $etudiant->setUserId($user);

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
