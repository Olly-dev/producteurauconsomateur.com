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
class UpdateFarmTest extends WebTestCase
{
    use AuthenticationTrait;


    public function testSuccessfulFarmUpdate(): void
    {
        $client = static::createAuthenticatedClient("producer@email.com");
        //dd("__ici__", $client);

        /**
         * @var RouterInterface $router
         */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("farm_update"));
        //dd("__ici__", $crawler);

        $form = $crawler->filter("form[name=farm]")->form([
            "farm[name]" => "Exploitation",
            "farm[description]" => "Description"
        ]);


        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
