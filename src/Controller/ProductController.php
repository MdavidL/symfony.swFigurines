<?php

namespace App\Controller;

use App\Entity\Productadd;
use App\Form\ProductType;
use App\Repository\ProductaddRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
        $product = new Productadd();
        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);


        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $coverFile = $productForm->get('picture')->getData();

            if ($coverFile) {

                $originalFilename = pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $coverFile->guessExtension();

                try {
                    $coverFile->move(
                        $this->getParameter('cover_directory'),
                        $newFilename
                    );

                } catch (FileException $e) {

                }

                $product->setPicture($newFilename);
            }
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', "Le produit a bien été enregistré !");
            return $this->redirectToRoute('dashboard');
        }
        return $this->render('admin/product-create.html.twig', [
            'productForm' => $productForm->createView()
        ]);
    }

    /**
     * @Route ("/admin/product/delete{id}", name="admin_product_delete")
     */
    public function productDelete($id, ProductaddRepository $productaddRepository, EntityManagerInterface $entityManager)
    {
        $product = $productaddRepository->find($id);

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('dashboard');

    }

    /**
     * @Route ("/admin/product/update{id}", name="admin_product_update")
     */
    public function productUpdate($id, Request $request, ProductaddRepository $productaddRepository, EntityManagerInterface $entityManager)
    {
        $product = $productaddRepository->find($id);

        $productForm = $this->createForm(ProductType::class, $product);

        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) {

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }


        return $this->render('admin/product-update.html.twig', [
            'productForm' => $productForm->createView()
            ]);
    }

    /**
     * @Route ("/admin/product{id}", name="admin_product")
     */
    public function product($id, ProductaddRepository $productaddRepository)
    {
        $product = $productaddRepository->find($id);

        return $this->render('admin/product.html.twig', ['product'=>$product]);
    }


}


