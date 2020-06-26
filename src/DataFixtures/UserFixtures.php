<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $doctor = new User();
        $doctor->setEmail('doctor@mail.com')
            ->setPassword($this->passwordEncoder->encodePassword($doctor, "pass"))
            ->setZipCode(73000)
            ->setIsVerified(1)
            ->setIsDoctor(1);

        $this->addReference('user_' . 2, $doctor);

        $manager->persist($doctor);

        $patient = new User();
        $patient->setEmail('mail@mail.com')
            ->setPassword($this->passwordEncoder->encodePassword($patient, "pass"))
            ->setZipCode(73000)
            ->setIsVerified(1)
            ->setIsDoctor(0);

        $this->addReference('user_' . 1, $patient);

        $manager->persist($patient);

        $manager->flush();
    }
}
