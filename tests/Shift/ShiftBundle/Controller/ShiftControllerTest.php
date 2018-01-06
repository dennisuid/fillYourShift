<?php

namespace Shift\ShiftBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShiftControllerTest extends WebTestCase
{
    public function TestView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/shift/view/1');
    }
}
