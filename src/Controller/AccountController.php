<?php

namespace App\Controller;

use App\Entity\Gite;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class AccountController extends AbstractController
{
     //Page avec les annonces des gens
     #[Route('/account/{id}', name: 'account')]
     public function showAccount(UserInterface $user, ManagerRegistry $doctrine, int $id): Response
     {
         $gite = $doctrine->getRepository(Gite::class)->find($id);
         $user = $gite->getUser();
 
         return $this->render('login/account.html.twig');
     }
 
     //Page account qui accueille avec le prénom de la personne
     #[Route('/account', name: 'account')]
     public function account(UserInterface $user): Response
     {
         return $this->render('account/account.html.twig', [
             'user' => $user
         ]);
     }

     //Page de création de nouvelle annonce
    #[Route('/house/new', name: 'create')]
    public function create(Request $request, UserInterface $user, ManagerRegistry $manager): Response
    {
        $gite = new Gite();

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
            'formGite' => $form->createView(),
            'editMode' => $gite->getId() !== null
        ]);
    }

    //Page de modification d'annonce
    /**
     * @Route("/house/{id}/edit", name="edit")
     * @Entity("gite", expr="repository.find(id)")
     */
    public function form(Gite $gite = null, Request $request, UserInterface $user, ManagerRegistry $manager): Response
    {

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
 
}