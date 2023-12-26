<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program', name: 'app_program')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Donkey Series',
        ]);
    }
    //     return new Response (
    //         '<!doctype html><html lang="en"><title>Donkey Series</title><body>Donkey Series Index</body></html>'        );
    // }

    //On peut écrire les requirements drectement dans les paramètres de route comme ceci:
    // #[Route('/program/{id}', name: 'app_program_show', methods: ['GET'], requirements: ['id' => '\d+'])]

    #[Route('/program/{id<^\d+$>}', name: 'app_program_show', methods:['GET'])]
    public function show(int $id): Response
    {
        return $this->render('/program/show.html.twig', [
            'id' => $id        
        ]);
    
    }
}
