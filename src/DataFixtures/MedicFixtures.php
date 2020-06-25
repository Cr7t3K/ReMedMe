<?php

namespace App\DataFixtures;

use App\Entity\Medic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MedicFixtures extends Fixture
{
    const MEDICS = [
        'DOLIPRANE 500 mg' => ['image' => 'https://www.drugs.com/images/pills/fio/JAN05750.JPG'],
        'VOLTARENE 100 mg' => ['image' => 'https://www.drugs.com/images/pills/nlm/155840101.jpg'],
        'IMODIUM 2 mg' => ['image' => 'https://www.drugs.com/images/pills/fio/UNI01280.JPG'],
        'PIASCLEDINE 300 mg' => ['image' => 'https://www.mailmyprescriptions.com/media/catalog/product/cache/image/1610x1000/925f46717e92fbc24a8e2d03b22927e1/m/a/mac00720_2.jpg'],
        'ISIMIG 2,5 mg' => ['image' => 'https://images.medscape.com/pi/features/drugdirectory/octupdate/ATX31400.jpg'],
        'SUBUTEX 2 mg' => ['image' => 'https://www.drugs.com/images/pills/fio/VTS03850.JPG'],
        'ORELOX 100 mg' => ['image' => 'https://img.medscapestatic.com/pi/features/drugdirectory/octupdate/DRR01660.jpg'],
        'COVERSYL 5 mg' => ['image' => 'https://www.mailmyprescriptions.com/media/catalog/product/cache/image/1610x1000/925f46717e92fbc24a8e2d03b22927e1/m/a/mac00680.jpg'],
        'FORLAX 10 g' => ['image' => 'https://images.medscape.com/pi/features/drugdirectory/octupdate/GSO01060.jpg'],
        'MOPRAL 10 mg' => ['image' => 'https://images.medscape.com/pi/features/drugdirectory/octupdate/DRR01642.jpg'],
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
