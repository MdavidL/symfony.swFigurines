<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController
{
    /**
     * @Route ("/admin/product/create", name="admin_product_create")
     */
    public function productCreate(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $product = new Product();
        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $coverFile = $productForm->get('picture')->getData();

            if ($coverFile) {

                $originalFilename = pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $coverFile->guessExtension();


                $coverFile->move(
                    $this->getParameter('cover_directory'),
                    $newFilename
                );

                $product->setPicture($newFilename);
            }
            $entityManager->persist($product);
            $entityManager->flush();
        }


        return $this->render('admin/product-create.html.twig', [
            'productForm' => $productForm->createView()
        ]);
    }
}
