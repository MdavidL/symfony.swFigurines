<?php

namespace App\Controller;

use App\Repository\ProductaddRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicMenuController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function home()
    {

        return $this->render('public/home.html.twig');

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

        $products = $productaddRepository->searchByProducts($word);

        return $this->render('public/search.html.twig', [
            'products' =>$products
        ]);
    }



}