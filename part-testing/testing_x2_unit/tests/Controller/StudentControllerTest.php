<?php

namespace App\Controller\Test;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }


    public function testListStudentsResponseOkay()
    {
        // Arrange
        $this->client->request('GET', '/student');

        // Act
        $statusCode = $this->client->getResponse()->getStatusCode();

        // Assert
        $this->assertEquals(200, $statusCode);
    }

    public function testListStudentsHeadingOkay()
    {
        // Arrange
//        $crawler = $this->client->request('GET', '/student');
        $this->client->request('GET', '/student');


        // needle - what we are searching for (as in a haystack!)
        $needle = 'Student index';

        // Act
        $content = $this->client->getResponse()->getContent();

        // Assert
        $this->assertContains($needle, $content);
    }
}