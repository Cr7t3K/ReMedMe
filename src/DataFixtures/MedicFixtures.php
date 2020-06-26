<?php

namespace App\DataFixtures;

use App\Entity\Medic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MedicFixtures extends Fixture
{
    const MEDICS = [
        'DOLIPRANE 500 mg' => ['image' => '/img/pill/1.png'],
        'VOLTARENE 100 mg' => ['image' => '/img/pill/2.png'],
        'IMODIUM 2 mg' => ['image' => '/img/pill/3.png'],
        'PIASCLEDINE 300 mg' => ['image' => '/img/pill/4.png'],
        'ISIMIG 2,5 mg' => ['image' => '/img/pill/5.png'],
        'SUBUTEX 2 mg' => ['image' => '/img/pill/6.png'],
        'ORELOX 100 mg' => ['image' => '/img/pill/7.png'],
        'COVERSYL 5 mg' => ['image' => '/img/pill/8.png'],
        'FORLAX 10 g' => ['image' => '/img/pill/5.png'],
        'MOPRAL 10 mg' => ['image' => '/img/pill/3.png'],
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::MEDICS as $name => $image) {
            $medic = new Medic();
            $medic->setName($name)
                ->setImage($image['image']);

            $manager->persist($medic);
        }

        $manager->flush();
    }
}
