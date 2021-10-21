<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class KnightFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        /*
         * public function testPostKnightBipolelm()
    {
        $client = static::createClient();

        $client->request('POST', '/knight', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"name":"Bipolelm","strength":10,"weaponPower":20}'
        );


        self::assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPostKnightElrynd()
    {
        $client = static::createClient();

        $client->request('POST', '/knight', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"name":"Elrynd","strength":10,"weaponPower":50}'
        );

        self::assertEquals(201, $client->getResponse()->getStatusCode());
    }
        */


        $KnightBipolelm = new Knight();
        $KnightBipolelm
            ->setName('Bipolelm')
            ->setStrenght(10)
            ->setWeaponPower(20)
        ;

        $KnightElrynd = new Knight();
        $KnightElrynd
            ->setName('Bipolelm')
            ->setStrenght(10)
            ->setWeaponPower(20)
        ;

        $manager->persist($KnightBipolelm);
        $manager->persist($KnightElrynd);

        $manager->flush();
    }
}
