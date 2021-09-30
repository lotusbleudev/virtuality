<?php

namespace App\Controller;

use App\Entity\Jeux;
use App\Entity\Places;
use App\Entity\Reservation;
use App\Entity\Tournois;
use App\Form\ReservationType;
use App\Repository\JeuxRepository;
use App\Repository\PlacesRepository;
use App\Repository\PrixRepository;
use App\Repository\TournoisRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class FrontController extends AbstractController
{
    #[Route('/tarifs', name: 'tarifs')]
    public function tarifs(PrixRepository $pr): Response
    {
        return $this->render('front/tarifs.html.twig', [
            "tarifs" => $pr->findAll(),
            "boxSemaine" => $pr->find('1'),
            "boxWeekend" => $pr->find('4'),
            "hallSemaine" => $pr->find('3'),
            "hallWeekend" => $pr->find('6'),
        ]);
    }

    #[Route('/jeux', name: 'jeux')]
    public function jeux(JeuxRepository $jr): Response
    {
        return $this->render('front/jeux.html.twig', [
            "jeux" => $jr->findAll()
        ]);
    }

    #[Route('jeu/{id}', name: 'jeu_detail', methods: ['GET'])]
    public function jeu_detail(Jeux $jeux): Response
    {
        return $this->render('front/detail-jeu.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route('/tournois', name: 'tournois')]
    public function tournois(TournoisRepository $tr): Response
    {
        return $this->render('front/tournois.html.twig', [
            "tournois" => $tr->findAll()
        ]);
    }

    #[Route('tournois/{id}', name: 'tournoi_detail')]
    public function tournois_detail(Tournois $tournois, UserInterface $user, TournoisRepository $tr, $id): Response
    {
        $tournoi = $tr->find($id);
        $joueurs = $tournoi->getJoueurs();

        $isInscrit = $joueurs->contains($user);
        
        return $this->render('front/detail-tournoi.html.twig', [
            "tournoi" => $tournois,
            "exist" =>  $isInscrit,
        ]);
    }

    #[Route('tournois/inscription/{id}', name: 'inscription_tournoi')]
    public function tournois_inscription(UserInterface $user, TournoisRepository $tr, EntityManager $em, $id): Response
    {
        $tournoi = $tr->find($id);
        $maxJoueurs = $tournoi->getMaxPlayer();
        $currentJoueurs = count($tournoi->getJoueurs());
        

        if($currentJoueurs == $maxJoueurs){

            $this->addFlash('error', 'Désolé Le nombre maximal de joueurs est déjà atteint.');

        }else{
            $tournoi->addJoueur($user);
            $em->persist($tournoi);
            $em->flush();

            $this->addFlash('success', 'Votre inscription au tournois a été réalisé avec succès.');
        }
        return $this->redirectToRoute("tournois");
    }

    #[Route('tournois/desinscription/{id}', name: 'desinscription_tournoi')]
    public function tournois_desinscription(UserInterface $user, TournoisRepository $tr, EntityManager $em, $id): Response
    {
        $tournoi = $tr->find($id);

            $tournoi->removeJoueur($user);
            $em->persist($tournoi);
            $em->flush();

            $this->addFlash('success', 'Vous vous êtes désinscrit de ce tournois.');
        
        return $this->redirectToRoute("tournois");
    }

    #[Route('/reservation', name: 'reservation')]
    public function reservation(Request $request, UserInterface $user, PrixRepository $pr, PlacesRepository $place, \Swift_Mailer $mailer): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);


        if ( $form->isSubmitted() && $form->isValid()) {
            $date = $form->get('date')->getData();
            $result = $date->format('Y-m-d H:i:s');

            function isWeekend($d)
            {
                $weekDay = date('w', strtotime($d));
                return ($weekDay == 0 || $weekDay == 6);
            }
            $isWe = isWeekend($result);

            if ($isWe) {
                $prix = $pr->find('4');
            } else {
                $prix = $pr->find('1');
            }

            $prixTotal = $prix->getMontant() * $form->get('nb_joueurs')->getData();

            $reservation->setPrixTotal($prixTotal);
            $reservation->setPrix($prix);
            $reservation->setUser($user);
            $reservation->setDate($date);


            $dispo = $place->findByJour($date);

            if (empty($dispo)) {
                $d = new Places();
                $d->setDate($date);
                $d->setDispos(20);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($d);
                $entityManager->flush();
                $dispo = $place->findByJour($date);
            }

            if (($dispo[0]->getDispos() - $form->get('nb_joueurs')->getData()) <= 0) {

                $this->addFlash('error', 'Oops! Plus de places disponibles pour cette date et ce créneau 😥. Essayez sur un autre créneau');
                // on ne peut pas faire la reservation
            } else {
                $dispo[0]->setDispos($dispo[0]->getDispos() - $form->get('nb_joueurs')->getData());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($reservation);
                $entityManager->flush();

                $this->addFlash('success', 'Félicitation! Vous avez bien réserver un créneau. Vous allez recevoir un email de confirmation');

                $message = (new \Swift_Message('Confirmation de votre réservation'))
                    ->setFrom('virtuality255@gmail.com')
                    ->setTo($reservation->getUser()->getEmail())
                    ->setBody(
                        $this->renderView(
                            'reservation/confirmation_reservation.html.twig',
                            compact('reservation')
                        ),
                        'text/html' // on lui dit que c'est des text/html car on veut qu'il prend en compte les balises dans notre vue 'confirmation_reservation'
                    );
                // on envoie le message
                $mailer->send($message);

                return $this->redirectToRoute('profil', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('front/reservation.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
}
