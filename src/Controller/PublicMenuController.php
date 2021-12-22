<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicMenuController extends AbstractController
{

    /**
     * @Route ("/", name="home")
     */
    public function home()
    {

        return $this->render('public/base.html.twig');

    }

}