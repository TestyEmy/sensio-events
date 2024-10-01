<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function index(Request $request): Response
    {
        // Récupérer le paramètre 'name' depuis l'URL
        $name = $request->query->get('name');

        return new Response('Hello ' . $name);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return new Response('contact');
    }
}

