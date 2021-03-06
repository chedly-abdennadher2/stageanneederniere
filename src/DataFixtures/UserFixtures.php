<?php

namespace App\DataFixtures;

use App\Entity\user;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
     private $encoder;
    public  function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user =new user();
        $user->setUsername("demo");
        $user->setPassword($this->encoder->encodePassword($user,'demo'));
        $manager->persist($user);
        $manager->flush();
    }
}
