<?php

namespace App\Controller;

use App\Entity\Jeux;
use App\Form\JeuxType;
use App\Repository\JeuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/jeux')]
class JeuxController extends AbstractController
{
    #[Route('/', name: 'jeux_index', methods: ['GET'])]
    public function index(JeuxRepository $jeuxRepository): Response
    {
        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeuxRepository->findAll(),
        ]);
    }
    

    #[Route('/new', name: 'jeux_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $jeux = new Jeux();
        $form = $this->createForm(JeuxType::class, $jeux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($fichier = $form->get("img_cover")->getData()){

                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);

                $nomFichier = str_replace(" ", "_", $nomFichier);

                $nomFichier .= uniqid() . "." . $fichier->guessExtension();

                $fichier->move($this->getParameter("dossier_images"), $nomFichier);

                $jeux->setImgCover($nomFichier);
            }

            if($fichier = $form->get("img_gameplay")->getData()){
                $images = [];
                foreach($fichier as $f){

                    $nomFichier = pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME);
    
                    $nomFichier = str_replace(" ", "_", $nomFichier);
    
                    $nomFichier .= uniqid() . "." . $f->guessExtension();
    
                    $f->move($this->getParameter("dossier_images"), $nomFichier);
                    
                    array_push($images, $nomFichier);
                }
                $jeux->setImgGameplay($images);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jeux);
            $entityManager->flush();

            return $this->redirectToRoute('jeux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jeux/new.html.twig', [
            'jeux' => $jeux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'jeux_show', methods: ['GET'])]
    public function show(Jeux $jeux): Response
    {
        return $this->render('jeux/show.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route('/{id}/edit', name: 'jeux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jeux $jeux): Response
    {
        $form = $this->createForm(JeuxType::class, $jeux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jeux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jeux/edit.html.twig', [
            'jeux' => $jeux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'jeux_delete', methods: ['POST'])]
    public function delete(Request $request, Jeux $jeux): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeux->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jeux);
            $entityManager->flush();

            $this->addFlash('success', 'Votre ajout a été réalisé avec succès');

        }

        return $this->redirectToRoute('jeux_index', [], Response::HTTP_SEE_OTHER);
    }
}
