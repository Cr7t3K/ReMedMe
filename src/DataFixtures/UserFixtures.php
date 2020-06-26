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
        $user = new User();
        $user->setEmail('patient@mail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user, "pass"))
            ->setZipCode(73000)
            ->setIsVerified(0);

        $this->addReference('user_' . 1, $user);

        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('doctor@mail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user2, "pass"))
            ->setZipCode(73000)
            ->setIsVerified(1);

        $this->addReference('user_' . 2, $user2);

        $manager->persist($user2);

        $manager->flush();
    }
}
