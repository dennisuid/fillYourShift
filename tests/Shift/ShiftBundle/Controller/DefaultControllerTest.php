<?php

namespace Tests\Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        //best to test the logo here
        $this->assertContains('Your place to match your skills with market', $client->getResponse()->getContent());
    }
}
