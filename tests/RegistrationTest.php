<?php

declare(strict_types=1);

namespace App\Tests;

use Generator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *  class RegistrationTest
 * @package App\Tests
 */
class RegistrationTest extends WebTestCase
{
    /**
     *
     * @param string $role
     * @dataProvider provideRoles
     * @return void
     */
    public function testSuccessfulRegistration(string $role): void
    {
        $client = static::createClient();

        /**
         * @var RouterInterface $router
         */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("security_registration", [
            "role" => $role
        ]));

        $form = $crawler->filter("form[name=registration]")->form([
            "registration[email]" => "email@email.com",
            "registration[plainPassword]" => "password",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     *
     * @return Generator
     */
    public function provideRoles(): Generator
    {
        yield ['producer'];
        yield ['customer'];
    }
}
