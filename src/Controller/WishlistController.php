<?php

namespace App\Controller;

use App\Entity\WishlistProduct;
use App\Form\WishlistType;
use App\Repository\WishlistProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WishlistController extends AbstractController
{
    /**
     * @Route ("/wishlist/create", name="wishlist_create")
     */
    public function wishlistCreate(Request $request, EntityManagerInterface $entityManager)
    {
        $wishlist = new WishlistProduct();
        $wishlistForm = $this->createForm(WishlistType::class, $wishlist);
        $wishlistForm->handleRequest($request);

        if ($wishlistForm->isSubmitted() && $wishlistForm->isValid()) {

            $entityManager->persist($wishlist);
            $entityManager->flush();

            $this->addFlash('success', "Le produit a bien été enregistré !");
            return $this->redirectToRoute('wishlist');
        }
        return $this->render('public/wishlist.html.twig', [
            'wishlistForm' => $wishlistForm->createView()
        ]);
    }

    /**
     * @Route ("/wishlist{id}", name="wishlist")
     */
    public function wishlistAdd($id, WishlistProductRepository $wishlistProductRepository, EntityManagerInterface $entityManager)
    {

        $wishlist = $wishlistProductRepository->find($id);

        $entityManager->flush();

        return $this->render('public/wishlist.html.twig', [
            'wishlist_product'=>$wishlist]);
    }

}

   //   /**
     //* @Route ("/wishlist/add", name="wishlist")
     //*/
    //public function wishlistAdd( Request $request, WishlistProductRepository $wishlistProductRepository, EntityManagerInterface $entityManager)
    //{
      //  $wishlist = $wishlistProductRepository->findAll();
        //$wishlistForm = $this->createForm(WishlistType::class, $wishlist);
        //$wishlistForm->handleRequest($request);

        //$entityManager->add($wishlist);
        //$entityManager->flush();

        //return $this->render('public/wishlist.html.twig', [
            //'wishlistForm' => $wishlistForm->createView()
        //]);

    //}

