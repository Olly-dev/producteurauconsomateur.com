<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Form\StockType;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  class ProductController
 * @package App\Controller
 * @Route("/products")
 * @IsGranted("ROLE_PRODUCER")
 */
class ProductController extends AbstractController
{
    /**
     *
     * @param ProductRepository $productRepository
     * @return Response
     * @Route("/", name="product_index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render("ui/product/index.html.twig", [
            "products" => $productRepository->findByFarm($this->getUser()->getFarm())
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return Response
     * @Route("/create", name="product_create")
     */
    public function create(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                "success",
                "Votre produit a été crée avec succès."
            );
            return $this->redirectToRoute("product_index");
        }

        return $this->render("ui/product/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     * @Route("/{id}/update", name="product_update")
     * @IsGranted("update", subject="product")
     */
    public function update(Product $product, Request $request): Response
    {
        $form = $this->createForm(ProductType::class, $product)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                "success",
                "Votre produit a été modifié avec succès."
            );
            return $this->redirectToRoute("product_index");
        }

        return $this->render("ui/product/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Product $product
     * @return Response
     * @Route("/{id}/delete", name="product_delete")
     * @IsGranted("delete", subject="product")
     */
    public function delete(Product $product): Response
    {
            $this->getDoctrine()->getManager()->remove($product);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                "success",
                "Votre produit a été suprimé avec succès."
            );
            return $this->redirectToRoute("product_index");
    }



    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     * @Route("/{id}/stock", name="product_stock")
     * @IsGranted("update", subject="product")
     */
    public function stock(Product $product, Request $request): Response
    {
        $form = $this->createForm(StockType::class, $product)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                "success",
                "Le stock de votre produit a été modifié avec succès."
            );
            return $this->redirectToRoute("product_index");
        }

        return $this->render("ui/product/stock.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
