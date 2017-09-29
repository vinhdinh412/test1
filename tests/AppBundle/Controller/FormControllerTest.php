<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class FormControllerTest extends WebTestCase
{


    public function testIndex()
    {
        $client = static::createClient();

 $crawler = $client->request('GET', '/login');
    $form = $crawler->selectButton('Login')->form();
	$crawler = $client->submit($form);

      $this->assertTrue($client->getResponse()->isRedirect());
    }
     public function testform()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{_locale}/form');

         $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Eng")')->count()
       );
    }
    public function testlogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
 }
}
