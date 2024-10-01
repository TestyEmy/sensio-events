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
        // Récupérer le User-Agent
        $userAgent = $request->headers->get('User-Agent');


        return $this->render('main/index.html.twig', [
            'name' => $name,
            'userAgent' => $userAgent,
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }
}

