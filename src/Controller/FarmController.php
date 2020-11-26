<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\FarmType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  class FarmController
 * @package App\Controller
 * @Route("/farm")
 * @IsGranted("ROLE_PRODUCER")
 */
class FarmController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return Response
     * @Route("/update", name="farm_update")
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
