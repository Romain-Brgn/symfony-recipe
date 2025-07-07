<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterForm;
use App\Repository\RecetteRepository;
use App\Mail\NewsletterSubscribedConfirmation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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

    #[Route('/newsletter', name: 'newsletter')]
    public function displayNewsletter(
        Request $request,
        EntityManagerInterface $em,
        NewsletterSubscribedConfirmation $sender
    ): Response {
        $newsletter = new Newsletter;
        $form = $this->createForm(NewsletterForm::class, $newsletter);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($newsletter);
            $em->flush();

            $this->addFlash('success', "Votre inscription a bien été prise en compte !");

            $sender->send($newsletter);
        }
        return $this->render('newsletter.html.twig', ['form' => $form]);
    }


}