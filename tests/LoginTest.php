<?php

declare(strict_types=1);

namespace App\Tests;

use Generator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *  class LoginTest
 * @package App\Tests
 */
class LoginTest extends WebTestCase
{
    /**
     *
     * @param string $email
     * @dataProvider provideEmails
     * @return void
     */
    public function testSuccessfulLogin(string $email): void
    {
        $client = static::createClient();

       /**
         * @var RouterInterface $router
         */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("security_login"));
        

        $form = $crawler->filter("form[name=login]")->form([
            "email" => $email,
            "password" => "password"
        ]);
        //dd($crawler);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     *
     * @return Generator
     */
    public function provideEmails(): Generator
    {
        yield ['producer@email.com'];
        yield ['customer@email.com'];
    }
}
