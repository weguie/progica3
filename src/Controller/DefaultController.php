<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Gite;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $gite = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(110, 118)]);
        $giteRand = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(109, 118)]);

        return $this->render('default/index.html.twig', [
            'gite' => $gite,
            'giteRand' => $giteRand
        ]);
    }

    #[Route('/account', name: 'account')]
    public function account(): Response
    {
        return $this->render('login/account.html.twig');
    }

    #[Route('/gites', name: 'gites')]
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Gite::class);

        $gites = $repo->findAll();
        return $this->render('default/gites.html.twig', [
            'gites' => $gites,
        ]);
    }

    #[Route('/apropos', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('default/apropos.html.twig');
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        $gite = new Gite();

        $form = $this->createFormBuilder($gite)
                    ->add('');



        return $this->render('login/create.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }



    #[Route('/show/{id}', name: 'show_house')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $gite = $doctrine->getRepository(Gite::class)->find($id);
        $dispo = $doctrine->getRepository(Gite::class)->find($id);

        return $this->render('default/show.html.twig', [
            'gite' => $gite,
        ]);
    }
}
