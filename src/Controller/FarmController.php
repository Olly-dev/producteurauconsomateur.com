<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Farm;
use App\Form\FarmType;
use App\Repository\FarmRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  class FarmController
 * @package App\Controller
 * @Route("/farm")
 */
class FarmController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @param [type] $farmRepositoy
     * @return JsonResponse
     * @Route("/all", name="farm_all")
     */
    public function all(FarmRepository $farmRepositoy, SerializerInterface $serializer): JsonResponse
    {
        $farms = $serializer->serialize($farmRepositoy->findAll(), 'json', ["groups" => "read"]);
        return new JsonResponse($farms, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * Undocumented function
     *
     * @param Farm $farm
     * @return Response
     * @Route("/{id}/show", name="farm_show")
     */
    public function show(Farm $farm, ProductRepository $productRepository): Response
    {
        return $this->render("/ui/farm/show.html.twig", [
            "farm" => $farm,
            "products" => $productRepository->findByFarm($farm)
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return Response
     * @Route("/update", name="farm_update")
     * @IsGranted("ROLE_PRODUCER")
     */
    public function update(Request $request): Response
    {
        $form = $this->createForm(FarmType::class, $this->getUser()->getFarm())->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                "success",
                "Les informations de votre exploitation ont été modifiées avec succès."
            );
            return $this->redirectToRoute("farm_update");
        }

        return $this->render("ui/farm/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
