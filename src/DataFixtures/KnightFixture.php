<?php

namespace App\DataFixtures;

use App\Entity\Knight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class KnightFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $KnightBipolelm = new Knight('Bipolelm', 10 ,20);
        $manager->persist($KnightBipolelm);

        $KnightElrynd = new Knight('Elrynd', 10, 50);
        $manager->persist($KnightElrynd);

        $manager->flush();
    }
}
