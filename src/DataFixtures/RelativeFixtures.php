<?php

namespace App\DataFixtures;

use App\Entity\Relative;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RelativeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $relative = new Relative();
        $relative->setFirstName('Emilie')
            ->setLastName('Tronc')
            ->setBirthdate(new \DateTime('1985-07-22 00:00:00'))
            ->setIsUser(0)
            ->setGender('female')
            ->setRelationship('parent')
            ->setUserId($this->getReference('user_' . 1));


        $manager->persist($relative);

        $relative2 = new Relative();
        $relative2->setFirstName('Marc')
            ->setLastName('Tronc')
            ->setBirthdate(new \DateTime('1986-12-22 00:00:00'))
            ->setIsUser(0)
            ->setGender('male')
            ->setRelationship('parent')
            ->setUserId($this->getReference('user_' . 1));


        $manager->persist($relative2);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
