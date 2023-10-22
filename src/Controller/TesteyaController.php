<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TesteyaController extends AbstractController
{
    #[Route('/testeya', name: 'app_testeya')]
    public function index(): Response
    {
        return $this->render('testeya/index.html.twig', [
            'controller_name' => 'TesteyaController',
        ]);
    }
    #[Route('/affiche', name: 'app_affiche')]
    public function Affiche()
    {
        return new Response ("<h1>bonjour mon amour</h1>");
    }

}
