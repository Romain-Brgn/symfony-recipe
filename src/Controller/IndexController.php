<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/recipe', name: 'allRecipes')]
    public function displayRecipes(RecetteRepository $RecetteRepository): Response
    {
        $recettes = $RecetteRepository->findAll();

        return $this->render('index/allRecipes.html.twig', ['recettes' => $recettes]);
    }
}
