<?php

namespace App\Controller;

use App\Repository\JeuxRepository;
use App\Repository\PrixRepository;
use App\Repository\TournoisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/tarifs', name: 'tarifs')]
    public function tarifs(PrixRepository $pr): Response
    {
        return $this->render('front/tarifs.html.twig', [
            "tarifs" => $pr->findAll()
        ]);
    }

    #[Route('/jeux', name: 'jeux')]
    public function jeux(JeuxRepository $jr): Response
    {
        return $this->render('front/jeux.html.twig', [
            "jeux" => $jr->findAll()
        ]);
    }

    #[Route('/tournois', name: 'tournois')]
    public function tournois(TournoisRepository $tr): Response
    {
        return $this->render('front/tournois.html.twig', [
            "tournois" => $tr->findAll()
        ]);
    }
}
