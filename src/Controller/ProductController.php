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

//Controller extends from the AbstractController
class ProductController extends AbstractController
{
    //I want to create a form in order to create some new products in my Database.
    //I use Annotations to create a Route. It will be the URL name.
    /**
     * @Route ("/admin/product/create", name="admin_product_create")
     */
    //I create a public function for my Controller. So the productCreate() method will be called when a user browses to it.
    public function productCreate(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $product = new Productadd();
        //I declare a variable for the form and I use the createForm method.
        //I call the Form which was created before by using the class "ProductType"
        $productForm = $this->createForm(ProductType::class, $product);
        //I call the handleRequest to process form data
        $productForm->handleRequest($request);

        //I use the isSubmitted and isValid methods in order to secure the input.
        //isValid call the database for a request
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            // for the uploading image
            // get the data image
            $coverFile = $productForm->get('picture')->getData();

            if ($coverFile) {
                //get the name of the image
                $originalFilename = pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME);
                //rename the file with an unique name
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $coverFile->guessExtension();
                // move the file inside the public directory
                try {
                    $coverFile->move(
                        $this->getParameter('cover_directory'),
                        $newFilename
                    );

                } catch (FileException $e) {

                }
                // save the name inside the newFilename column
                $product->setPicture($newFilename);
            }
            $entityManager->persist($product);
            $entityManager->flush();
            // I want a message for the confirmation of the product created
            $this->addFlash('product-ok', "La fiche a bien été créée !");
            return $this->redirectToRoute('dashboard');
        }
        // I create a view in order to display the form
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

            $this->addFlash('product-update', "La fiche a bien été mise à jour !");
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


