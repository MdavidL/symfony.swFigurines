<?php

namespace App\Controller;

use App\Repository\ProductaddRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route ("/dashboard", name="dashboard")
     */
    public function dashboard(ProductaddRepository $productaddRepository)
    {
        $productadd = $productaddRepository->findAll();
        return $this->render('admin/dashboard.html.twig', [
            'products' =>$productadd
        ]);
    }
}

