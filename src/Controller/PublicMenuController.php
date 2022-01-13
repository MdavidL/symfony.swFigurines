<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\ProductaddRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicMenuController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function home(Request $request, EntityManagerInterface $entityManager, ProductaddRepository $productaddRepository)
    {
        $newsletter = new Newsletter();
        $newsletterForm = $this->createForm(NewsletterType::class, $newsletter);
        $newsletterForm->handleRequest($request);
            $lastFigures = $productaddRepository->findBy([], ['id' => 'DESC'], 4);

        if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {

            $entityManager->persist($newsletter);
            $entityManager->flush();

        }
        return $this->render('public/home.html.twig', [
            'newsletterForm' => $newsletterForm->createView(),
            'lastFigures'=> $lastFigures,
        ]);
    }

    /**
     * @Route ("/products", name="products")
     */
    public function products(ProductaddRepository $productaddRepository)
    {
        $productadd = $productaddRepository->findAll();
        return $this->render('public/products.html.twig', [
            'products' =>$productadd
        ]);
    }

    /**
     * @Route ("/product{id}", name="public_product")
     */
    public function product($id, ProductaddRepository $productaddRepository)
    {
        $product = $productaddRepository->find($id);

        return $this->render('public/product.html.twig', ['product'=>$product]);
    }


    /**
     * @Route ("/search", name="public_search_products")
     */
    public function searchProducts(ProductaddRepository $productaddRepository, Request $request)
    {
        $word = $request->query->get('q');

        $products = $productaddRepository->searchByName($word);

        return $this->render('public/research.html.twig', [
            'products' =>$products
        ]);
    }


}