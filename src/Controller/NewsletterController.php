<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    /**
     * @Route ("/newsletter", name="newsletter")
     */
    public function newsletter(Request $request, EntityManagerInterface $entityManager)
    {
        $newsletter = new Newsletter();
        $newsletterForm = $this->createForm(NewsletterType::class, $newsletter);
        $newsletterForm->handleRequest($request);

        if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {

            $entityManager->persist($newsletter);
            $entityManager->flush();

            $this->addFlash('mail-ok', "Votre mail a bien été enregistré !");
            return $this->redirectToRoute('home');

        }
        return $this->render('public/home.html.twig', [
            'newsletterForm' => $newsletterForm->createView()
        ]);
    }
}