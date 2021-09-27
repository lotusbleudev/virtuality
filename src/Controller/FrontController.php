<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/tarifs', name: 'tarifs')]
    public function tarifs(): Response
    {
        return $this->render('front/tarifs.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/jeux', name: 'jeux')]
    public function jeux(): Response
    {
        return $this->render('front/jeux.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/tournois', name: 'tournois')]
    public function tournois(): Response
    {
        return $this->render('front/tournois.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
}
