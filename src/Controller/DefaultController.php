<?php

namespace App\Controller;

use App\Entity\Gite;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;


class DefaultController extends AbstractController
{
    //Affiche 2 gîtes aléatoirement sur la page home
    #[Route('/', name: 'app_default')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $gite = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(179, 188)]);
        $giteRand = $doctrine->getRepository(Gite::class)->findOneBy(['id' => rand(179, 188)]);

        return $this->render('default/index.html.twig', [
            'gite' => $gite,
            'giteRand' => $giteRand
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
