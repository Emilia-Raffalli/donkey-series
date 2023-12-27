<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program', name: 'app_program')]
    public function index(ProgramRepository $programRepository, EntityManagerInterface $em): Response
    {
        $programs = $programRepository->findAll();

        $latestProgram = $em->getRepository(Program::class)
        ->findOneBy([], ['createdAt' => 'DESC']);

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            'latestProgram' => $latestProgram
        ]);
    }

    #[Route('/program/{id<^\d+$>}', name: 'app_program_show', methods:['GET'])]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->find($id);
       

        if (!$program) {
            throw $this->createNotFoundException("Aucun programme trouvé avec l'id $id");
        }

        return $this->render('/program/show.html.twig', [
            'program' => $program,
            'id' =>$id,
        ]);
    }
    
}
