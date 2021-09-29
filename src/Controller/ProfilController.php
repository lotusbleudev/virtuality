<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function index(Request $request, UserInterface $u, UserRepository $ur, EntityManagerInterface $em): Response
    {

        if($request->query->get('submit')){

            $user = $ur->find($u);
            $user->setPrenom($request->query->get('prenom'));
            $user->setNom($request->query->get('nom'));
            $user->setTelephone($request->query->get('telephone'));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('profil/index.html.twig', [
            
        ]);
    }
}
