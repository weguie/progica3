<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Repository\GiteRepository;

use App\Form\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, GiteRepository $giteRepository): Response
    {
        $searchForm = $this->createForm(SearchFormType::class);

        if ($searchForm->handleRequest($request)->isSubmitted() && $searchForm->isValid()){
            $criteria = $searchForm->getData();
            $gites = $giteRepository->searchGiteTitle($criteria);
        }

        return $this->render('search/search.html.twig', [
            'search_form' => $searchForm->createView(),
            'gites' => $gites
        ]);
    }
}
