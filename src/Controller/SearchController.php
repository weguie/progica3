<?php

namespace App\Controller;

use App\Repository\GiteRepository;

use App\Form\SearchFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    //Fonction recherche 
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, GiteRepository $giteRepository): Response
    {
        // Initialisation de $gites
        $gites = null;
        //Création du formulaire
        $searchForm = $this->createForm(SearchFormType::class);

        // Si le formulaire est rempli et valide 
        if ($searchForm->handleRequest($request)->isSubmitted() && $searchForm->isValid()){
         
            //Récupération du formulaire
            $criteria = $searchForm->getData();
            //Recherche
            $gites = $giteRepository->searchGiteCity($criteria);
            // $gites = $giteRepository->searchGiteTitle($criteria);
        }

        return $this->render('search/search.html.twig', [
            //Envoyer le formulaire à la page "search.html.twig"
            'search_form' => $searchForm->createView(),
            'gites' => $gites
        ]);
    }
}
