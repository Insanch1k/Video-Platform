<?php

namespace App\Tests\Controllers\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerVideoTest extends WebTestCase
{
    public function testNoResults()
    {
        $client = static::createClient();
//        $client->followRedirect();

        $crawler = $client->request('GET','/');

        $form = $crawler->selectButton('Search video')->form([
            'query'=>'aaa',
        ]);

        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('No results', $crawler->filter('h1')->text());
    }

    public function testResultsFound()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('Search video')->form([
           'query'=>'Movies',
        ]);

        $crawler = $client->submit($form);
        $this->assertGreaterThan(4, $crawler->filter('h3')->count());

    }

    public function testSorting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('Search video')->form([
           'query'=>'Movies',
        ]);
        $crawler = $client->submit($form);

        $form = $crawler->filter('#form-sorting')->form([
            'sortby'=>'desc',
        ]);

        $crawler = $client->submit($form);

        $this->assertEquals('Movies 7', $crawler->filter('h3')->first()->text());

    }
}
