<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use App\Entity\Monrendu;
use App\Entity\Rendus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const Rendus_1 = "Rendus-1";
    private const rendu1="rendu1";

    private const artiste_1="artiste_1";
    
    private static function rendusDataGenerator()
    {
        yield [self::Rendus_1, "albums de rendus d'arbres"];
    }

    private static function rendusGenerator()
    {
        yield [self::rendu1 , "rendu d'un arbre","blender","cycles"];
    }

    private static function membreGenerator(){
        yield[self::artiste_1,2022,"artiste independant"];
    }
    
    public function load(ObjectManager $manager)
    {
        $inventoryRepo = $manager->getRepository(Rendus::class);
        foreach (self::rendusDataGenerator() as [$RendusReference,$description])
        {        
            $rendus= new Rendus();
            $rendus ->setDescription($description);
            $manager->persist($rendus);
            $manager->flush();

            $this->addReference($RendusReference,$rendus);
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

        foreach (self::membreGenerator() as [$artisteReference,$annee,$description])
        {        
            $membre= new Membre;
            $membre ->setDescription($description);
            $membre ->setActifDepuis($annee);
            $membre ->addTag($rendus);
            $manager->persist($monrendu);
            $manager->flush();

            $this->addReference($artisteReference,$monrendu);
        }
        
        $manager->flush();
        
    }
    
}
