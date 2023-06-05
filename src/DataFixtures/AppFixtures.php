<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Clientes;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $clienteA = new Clientes();
        $clienteA->setCliente('Cliente A');
        $clienteA->setEmail('clientea@gmail.com');
        $manager->persist($clienteA);
        $manager->flush();

        $clienteB = new Clientes();
        $clienteB->setCliente('Cliente B');
        $clienteB->setEmail('clienteb@gmail.com');
        $manager->persist($clienteB);
        $manager->flush();

        $clienteC = new Clientes();
        $clienteC->setCliente('Cliente C');
        $clienteC->setEmail('clientec@gmail.com');
        $manager->persist($clienteC);
        $manager->flush();
    }
}
