<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Recette;


final class RecetteController extends AbstractController
{
    #[Route('/recette/{id}', name: 'recette_detail')]
    public function show(Recette $recette): Response
    {
        return $this->render('show.html.twig', [
            'recette' => $recette,
        ]);
    }
}