<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            //Ici nous enverrons le mail
            // dd($contact);

            $message = (new \Swift_Message('Vous avez reçu un nouveau message'))
                ->setFrom($contact['email'])
                ->setTo('virtuality255@gmail.com')
                ->setBody(
                    $this->renderView(
                        'email/email_reçu.html.twig', compact('contact')
                    ),
                    'text/html' // on lui dit que c'est des text/html car on veut qu'il prend en compte les balises dans notre vue 'email_reçu'
                )
            ; 
            // on envoie le message
            $mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé avec succès'); // Il faut créer un template Flash_message

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }
}
