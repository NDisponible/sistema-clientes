<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher) 
    {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@gmail.com');
        $user->setRoles([]);
        $hashedPassword = $this->userPasswordHasher->hashPassword($user, 'hola');
        $user->setPassword($hashedPassword);
        $manager->persist($user);
        $manager->flush();
    }
}