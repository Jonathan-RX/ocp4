<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketsControllerTest extends WebTestCase
{
    public function testTicketsIsDown(){
        $client = static::createClient();
        $client->request('GET', '/tickets/00000000');

        $this->assertSame(500, $client->getResponse()->getStatusCode());
    }

}