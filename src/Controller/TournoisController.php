<?php

namespace App\Controller;

use App\Entity\Tournois;
use App\Form\TournoisType;
use App\Repository\TournoisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/tournois')]
class TournoisController extends AbstractController
{
    #[Route('/', name: 'tournois_index', methods: ['GET'])]
    public function index(TournoisRepository $tournoisRepository): Response
    {
        return $this->render('tournois/index.html.twig', [
            'tournois' => $tournoisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'tournois_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $tournoi = new Tournois();
        $form = $this->createForm(TournoisType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tournoi);
            $entityManager->flush();

            $this->addFlash('success', 'Félicitation!! Vous vous êtes bien inscrit.e au tournois.');

            return $this->redirectToRoute('tournois_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tournois/new.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tournois_show', methods: ['GET'])]
    public function show(Tournois $tournoi): Response
    {
        return $this->render('tournois/show.html.twig', [
            'tournoi' => $tournoi,
        ]);
    }

    #[Route('/{id}/edit', name: 'tournois_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tournois $tournoi): Response
    {
        $form = $this->createForm(TournoisType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Les modifictions dans ce tournois sont réalisées.');

            return $this->redirectToRoute('tournois_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tournois/edit.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tournois_delete', methods: ['POST'])]
    public function delete(Request $request, Tournois $tournoi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournoi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tournoi);
            $entityManager->flush();

            $this->addFlash('success', 'La suppression du tournois est éffectuée.');

        }

        return $this->redirectToRoute('tournois_index', [], Response::HTTP_SEE_OTHER);
    }
}
