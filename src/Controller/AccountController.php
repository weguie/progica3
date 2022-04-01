<?php

namespace App\Controller;

use App\Entity\Gite;
use App\Entity\Utilisateur;

use App\Repository\GiteRepository;
use App\Repository\UtilisateurRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\Security\Core;

class AccountController extends AbstractController
{
     //Page account qui accueille avec le prénom de la personne et les annonces 

     #[Route('/account', name: 'account')]
     public function account(UserInterface $user, ManagerRegistry $doctrine, GiteRepository $giteRepository): Response
     {
        // avoir accès à l'id de l'user de la session :
        // $IDUSER = explode(":", explode(";", $_SESSION["_sf2_attributes"]["_security_main"])[5])[1];

        $idUser = $this->getUser()->getId();
        $gite = $giteRepository->searchUser($idUser);

        if ($gite != null) {
            dump($gite);
            return $this->render('account/account.html.twig', [
            'user' => $user,
            'gite' => $gite[0]
        ]);
              
        } else {
            $gite = null;
            return $this->render('account/account.html.twig', [
                'user' => $user,
                'gite' => $gite
            ]);
        }
     }

    //Page de création de nouvelle annonce
    #[Route('/house/new', name: 'create')]
    public function create(Request $request, UserInterface $user, ManagerRegistry $manager): Response
    {
        //Nouvelle entité
        $gite = new Gite();
        //Formulaire
        $form = $this->createFormBuilder($gite)
                    ->add('title')
                    ->add('description')
                    ->add('image')
                    ->add('isAllowed')
                    ->add('isAllwoedPrice')
                    ->add('price')
                    ->add('location')
                    ->add('bed')
                    ->add('room')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $gite->setUser($user);
            $em = $manager->getManager();
            $em->persist($gite);
            $em->flush();
            return $this->redirectToRoute('show_house', ['id' => $gite->getId()]);
        }

        return $this->render('account/create.html.twig', [
            'formGite' => $form->createView()
        ]);
    }

    //Page de modification d'annonce
    /**
     * @Route("/house/edit/{id}", name="edit")
     * @Entity("gite", expr="repository.find(id)")
     */
    public function form(Gite $gite = null, Request $request, ManagerRegistry $manager): Response
    {
        // Formulaire
        $form = $this->createFormBuilder($gite)
                    ->add('title')
                    ->add('description')
                    ->add('image')
                    ->add('isAllowed')
                    ->add('isAllwoedPrice')
                    ->add('price')
                    ->add('location')
                    ->add('bed')
                    ->add('room')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em = $manager->getManager();
            $em->persist($gite);
            $em->flush();
            return $this->redirectToRoute('show_house', ['id' => $gite->getId()]);
        }

        return $this->render('account/create.html.twig', [
            'formGite' => $form->createView()
        ]);
    }

    //Suppression d'annonce 
    #[Route('/house/delete/{id}', name: 'delete')]
     public function delete(ManagerRegistry $doctrine, ManagerRegistry $manager, int $id): Response
     {
        $gite = $doctrine->getRepository(Gite::class)->find($id);
        $em = $manager->getManager();
        $em->remove($gite);
        $em->flush();

        return $this->render('account/delete.html.twig');
     }
 
}
