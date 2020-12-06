<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\Farm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 *  class FarmTest
 * @package App\Tests
 */
class FarmTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testSuccessfulFarmAll(): void
    {
        $client = static::createAuthenticatedClient("producer@email.com");
        //dd("__ici__", $client);

        /**
         * @var RouterInterface $router
         */
        $router = $client->getContainer()->get("router");

        $client->request(Request::METHOD_GET, $router->generate("farm_all"));

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }



    public function testSuccessfulFarmShow(): void
    {
        $client = static::createAuthenticatedClient("producer@email.com");
        //dd("__ici__", $client);

        /**
         * @var RouterInterface $router
         */
        $router = $client->getContainer()->get("router");

        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        $farm = $entityManager->getRepository(Farm::class)->findOneBy([]);

        $client->request(Request::METHOD_GET, $router->generate("farm_show", [
            "id" => $farm->getId()
        ]));

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

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
            "farm[description]" => "Description",
            "farm[address][address]" => "address",
            "farm[address][zipCode]" => "93100",
            "farm[address][city]" => "Paris",
            "farm[address][position][latitude]" => 46,
            "farm[address][position][longitude]" => 7.5
        ]);


        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
