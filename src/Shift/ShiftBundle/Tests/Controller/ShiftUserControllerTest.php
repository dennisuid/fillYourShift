<?php

namespace Shift\ShiftBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShiftUserControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/get');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/delete');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/update');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/add');
    }

    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/login');
    }

}
