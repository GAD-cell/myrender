<?php

namespace App\DataFixtures;

use App\Entity\Monrendu;
use App\Entity\Rendus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const Juliette_Rendus_1 = "Juliette-Rendus-1";
    private const rendu1="rendu1";

    
    private static function rendusDataGenerator()
    {
        yield [self::Juliette_Rendus_1, "Artiste 3D"];
    }

    private static function rendusGenerator()
    {
        yield [self::rendu1 , "rendu d'un arbre","blender","cycles",];
    }
    
    public function load(ObjectManager $manager)
    {
        $inventoryRepo = $manager->getRepository(Rendus::class);
        foreach (self::rendusDataGenerator() as [$artisteReference,$description])
        {        
            $rendus= new Rendus();
            $rendus ->setDescription($description);
            $manager->persist($rendus);
            $manager->flush();

            $this->addReference($artisteReference,$rendus);
        }
        
        foreach (self::rendusGenerator() as [$renduReference,$description,$logiciel,$moteur_rendu])
        {        
            $monrendu= new Monrendu;
            $monrendu ->setDescription($description);
            $monrendu ->setLogiciel($logiciel);
            $monrendu ->setMoteurRendu($moteur_rendu);
            $manager->persist($monrendu);
            $manager->flush();

            $this->addReference($renduReference,$monrendu);
        }
        $manager->flush();
        
    }
    
}
