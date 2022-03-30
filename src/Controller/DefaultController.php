<?php

namespace App\Controller;

use App\Entity\Gite;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;


class DefaultController extends AbstractController
{
    //Affiche 2 gîtes aléatoirement sur la page home
    #[Route('/', name: 'app_default')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $gite = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(146, 155)]);
        $giteRand = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(146, 155)]);

        return $this->render('default/index.html.twig', [
            'gite' => $gite,
            'giteRand' => $giteRand
        ]);
    }

    //Page account qui accueille avec le prénom de la personne
    #[Route('/account', name: 'account')]
    public function account(UserInterface $user): Response
    {
        return $this->render('login/account.html.twig', [
            'user' => $user
        ]);
    }

    //Page avec tous les gîtes 
    #[Route('/gites', name: 'gites')]
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Gite::class);

        $gites = $repo->findAll();
        return $this->render('default/gites.html.twig', [
            'gites' => $gites,
        ]);
    }

    //Page statique
    #[Route('/apropos', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('default/apropos.html.twig');
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

        return $this->render('login/create.html.twig', [
            'formGite' => $form->createView()
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

        return $this->render('login/create.html.twig', [
            'formGite' => $form->createView()
        ]);
    }

    //Page pour avoir plus de précision sur une annonce
    #[Route('/show/{id}', name: 'show_house')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $gite = $doctrine->getRepository(Gite::class)->find($id);
        $user = $gite->getUser();
        $pets = $gite->getIsAllowed();

        if ($pets == '1') {
            $answer = "Oui";
        } else {
            $answer = "Non";
        }

        return $this->render('default/show.html.twig', [
            'gite' => $gite,
            'user' => $user,
            'answer' => $answer 
        ]);
    }
}
