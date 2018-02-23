<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test that implements a "smoke test" of all the public and secure
 * URLs of the application.
 * See https://symfony.com/doc/current/best_practices/tests.html#functional-tests.
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class DefaultControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }


    public function testHomepageSaysHelloWithHtmlFilter()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $searchText = 'Hello World';

        // Act
        $crawler = $this->client->request($httpMethod, $url);


        // Assert
        $this->assertGreaterThan(
            0,
            $crawler->filter("html:contains($searchText)")->count()
        );
    }

    public function testHomepageSaysHello()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $searchText = 'Hello World';

        // Act
        $this->client->request($httpMethod, $url);

        // Assert
        $this->assertContains(
            $searchText,
            $this->client->getResponse()->getContent()
        );
    }

    /**
     * PHPUnit's data providers allow to execute the same tests repeated times
     * using a different set of data each time.
     * See https://symfony.com/doc/current/cookbook/form/unit_testing.html#testing-against-different-sets-of-data.
     *
     * @dataProvider getPublicUrls
     */
    public function testPublicUrls(string $url)
    {
        // Arrange
        $httpMethod = 'GET';
//        $client = static::createClient();

        // Assert
        $this->client->request($httpMethod, $url);

        // Assert
        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode(),
            sprintf('The %s public URL loads correctly.', $url)
        );

    }


    /**
     * return URLs for testing ...
     * @return \Generator
     */
    public function getPublicUrls()
    {
        yield ['/'];
    }


}