<?php

namespace App\Controller;

use App\Entity\Gite;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class DefaultController extends AbstractController
{
    // Page Accueil, Affiche 2 gîtes aléatoirement (à ajouter un vrai rand de la bdd)

    #[Route('/', name: 'app_default')]
    public function index(ManagerRegistry $doctrine): Response
    {
        //Appel de doctrine pour trouver un gîte avec un id rand
        $gite = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(179, 188)]);
        $giteRand = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(179, 188)]);

        return $this->render('default/index.html.twig', [
            'gite' => $gite,
            'giteRand' => $giteRand
        ]);
    }

    // Page qui recense tous les gîtes 

    #[Route('/gites', name: 'gites')]
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $gites = $doctrine->getRepository(Gite::class)->findAll();

        return $this->render('default/gites.html.twig', [
            'gites' => $gites,
        ]);
    }

    //Page statique "à propos"

    #[Route('/apropos', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('default/apropos.html.twig');
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