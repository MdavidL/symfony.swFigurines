<?php

namespace App\Controller;

use App\Entity\WishlistProduct;
use App\Form\WishlistType;
use App\Repository\ProductaddRepository;
use App\Repository\WishlistProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WishlistController extends AbstractController
{
    /**
     * @Route ("/wishlist", name="public_wishlist")
     */
    public function wishlist(ProductaddRepository $productaddRepository)
    {
        $wishlist = $productaddRepository->findBy([], ['id' => 'ASC'], 2);

        return $this->render('public/wishlist.html.twig', [
            'wishlist' =>$wishlist
        ]);
    }

}
