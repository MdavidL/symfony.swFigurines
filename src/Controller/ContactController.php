<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route ("/contact", name="public_contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);
        if($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactFormData = $contactForm->getData();

            $email = (new Email())
                ->from($contactFormData('email'))
                ->to('ton@gmail.com')
                ->subject('vous avez reçu un email')
                ->text(
                    'text/plain');
            $mailer->send($email);
            $this->addFlash('success', 'Vore message a été envoyé');
            return $this->redirectToRoute('contact');
        }
        return $this->render('public/contact-index.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }

}