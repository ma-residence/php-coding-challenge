<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class KnightControllerTest extends WebTestCase
{

    public function testPostKnightBipolelm()
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

    public function testPostBadKnight()
    {
        $client = static::createClient();

        $client->request('POST', '/knight', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"name":"FAILED"}'
        );

        $content = json_decode($client->getResponse()->getContent(), true);

        self::assertEquals(400, $client->getResponse()->getStatusCode());

        self::assertArrayHasKey('code', $content);
        self::assertArrayHasKey('message', $content);
        self::assertEquals(Response::HTTP_BAD_REQUEST, $content['code']);
        self::assertEquals('form is not valid', $content['message']);
    }

    public function testGetKnightAll()
    {
        $client = static::createClient();

        $client->request('GET', '/knights', [], [], []);

        $content = json_decode($client->getResponse()->getContent(), true);

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        self::assertArrayHasKey('id', $content['data'][0]);
        self::assertArrayHasKey('name', $content['data'][0]);
        self::assertArrayHasKey('strength', $content['data'][0]);
        self::assertArrayHasKey('weaponPower', $content['data'][0]);

        self::assertEquals(1, $content['data'][0]['id']);
        self::assertGreaterThan(2, $content['data']);
    }

    public function testGetKnightNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/knight/1000', [], [], []);

        $content = json_decode($client->getResponse()->getContent(), true);

        self::assertEquals(404, $client->getResponse()->getStatusCode());

        self::assertArrayHasKey('code', $content);
        self::assertArrayHasKey('message', $content);

        self::assertEquals('Knight #1000 not found.', $content['message']);
    }
}
