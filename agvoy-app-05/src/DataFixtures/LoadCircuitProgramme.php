<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgrammationCircuit;

class LoadCircuitProgramme extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $circuit=$this->getReference('andalousie-circuit');
    
        $programmation = new ProgrammationCircuit();
        $programmation-> setDateDepart(\DateTime::createFromFormat('Ymd', '20170101'));
        $programmation-> setNombrePersonnes(6);
        $programmation-> setPrix('25');
        $circuit->addProgrammation($programmation);
        $manager->persist($programmation);
        
        $programmation = new ProgrammationCircuit();
        $programmation-> setdateDepart(\DateTime::createFromFormat('Ymd', '20180101'));
        $programmation-> setnombrePersonnes(3);
        $programmation-> setprix('35');
        $circuit->addProgrammation($programmation);
        $manager->persist($programmation);
        
        $manager->flush();
   
    }
    
    public function getDependencies()
    {
        return array(
            LoadCircuitData::class,
        );
    }
}