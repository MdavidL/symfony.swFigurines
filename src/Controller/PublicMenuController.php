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
    public function home(Request $request, EntityManagerInterface $entityManager)
    {
        $newsletter = new Newsletter();
        $newsletterForm = $this->createForm(NewsletterType::class, $newsletter);
        $newsletterForm->handleRequest($request);

        if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {

            $entityManager->persist($newsletter);
            $entityManager->flush();

            $this->addFlash('success', "Votre mail a bien été enregistré !");
            return $this->redirectToRoute('home');
        }
        return $this->render('public/home.html.twig', [
            'newsletterForm' => $newsletterForm->createView()
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
     * @Route ("/search", name="public_search_products")
     */
    public function searchProducts(ProductaddRepository $productaddRepository, Request $request)
    {
        $word = $request->query->get('q');

        $products = $productaddRepository->searchByName($word);

        return $this->render('public/search.html.twig', [
            'products' =>$products
        ]);
    }




}