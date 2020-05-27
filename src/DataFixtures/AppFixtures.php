<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $marque1 = new Marque();
        $marque1->setLibelle("Toyota");
        $manager->persist($marque1);

        $marque2 = new Marque();
        $marque2->setLibelle("Peugeot");
        $manager->persist($marque2);

        $model1 = new Modele();
        $model1->setLibelle("Yaris")
              ->setImage("model1.jpg")
              ->setPrixMoyen(15000)
              ->setMarque($marque1);
        $manager->persist($model1);

        $model2 = new Modele();
        $model2->setLibelle("Corolla")
              ->setImage("model2.jpg")
              ->setPrixMoyen(25000)
              ->setMarque($marque1);
        $manager->persist($model2);  

        $model3 = new Modele();
        $model3->setLibelle("407")
              ->setImage("model3.jpg")
              ->setPrixMoyen(20000)
              ->setMarque($marque2);
        $manager->persist($model3);  

        $model4 = new Modele();
        $model4->setLibelle("508 SW")
              ->setImage("model4.jpg")
              ->setPrixMoyen(15000)
              ->setMarque($marque2);
        $manager->persist($model4);  

        $model5 = new Modele();
        $model5->setLibelle("Yaris")
              ->setImage("model5.jpg")
              ->setPrixMoyen(15000)
              ->setMarque($marque2);
        $manager->persist($model5);  

        $modeles = [$model1, $model2, $model3, $model4, $model5];

        $faker = \Faker\Factory::create('fr_FR');
        foreach($modeles as $m)
        {
            $rand = rand(3, 5);
            for($i = 1; $i <= $rand; $i++)
            {
                $voiture = new Voiture();
                $voiture->setImmatriculation($faker->regexify("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                        ->setNbPortes($faker->randomElement($array = array(3,5)))
                        ->setAnnee($faker->numberBetween($min=1990, $max=2019))
                        ->setModele($m);
                $manager->persist($voiture);
            }
        }
    
        $manager->flush();
    }
}
