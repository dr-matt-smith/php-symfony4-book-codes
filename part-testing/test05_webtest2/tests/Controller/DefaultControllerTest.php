<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class DefaultControllerTest extends WebTestCase
{
    public function testHomepageResponseCodeOkay()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();

        // Assert
        $client->request($httpMethod, $url);

        // Assert
        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testHomepageContentContainsHelloWorld()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Hello World';

        // Act
        $client->request($httpMethod, $url);

        // Assert
        $this->assertContains(
            $searchText,
            $client->getResponse()->getContent()
        );
    }
}