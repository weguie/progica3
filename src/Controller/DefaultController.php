<?php

namespace App\Controller;

use App\Entity\Option;
use App\Repository\CitiesRepository;
use App\Repository\GiteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    // Page Accueil, Affiche 2 gîtes aléatoirement

    #[Route('/', name: 'app_default')]
    public function index(GiteRepository $giteRepository, ManagerRegistry $doctrine, CitiesRepository $citiesRepository): Response
    {
        //Récupérer liste des gîtes
        $list = $giteRepository->findAll();
        //Récupérer la longueur de l'array list pour le rand
        $listLength = count($list)-1;

        //Trouver un gîte avec un id rand
        $giteRand1 = $giteRepository->findOneBy(['id' => $list[rand(0, $listLength)]]);
        $giteRand2 = $giteRepository->findOneBy(['id' => $list[rand(0, $listLength)]]);

        $cityId1 = $giteRand1->getCity()->getId();
        $cityId2 = $giteRand2->getCity()->getId();

        $city1 = $citiesRepository->findBy(['id' => $cityId1]);
        $city2 = $citiesRepository->findBy(['id' => $cityId2]);

        return $this->render('default/index.html.twig', [
            'gite' => $giteRand1,
            'giteRand' => $giteRand2,
            'city1' => $city1[0],
            'city2' => $city2[0]
        ]);
    }

    // Page qui recense tous les gîtes 

    #[Route('/gites', name: 'gites')]
    public function showAll(GiteRepository $giteRepository): Response
    {
        $gites = $giteRepository->findAll();

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
    public function show(GiteRepository $giteRepository, int $id): Response
    {
        //Trouver le gîte avec cet Id
        $gite = $giteRepository->find($id);
        //Trouver utilisateur
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
            'answer' => $answer,
        ]);
    }
}