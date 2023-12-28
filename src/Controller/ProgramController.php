<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
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
    public function show(int $id, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->find($id);
        $seasons = $seasonRepository->findby(['program'=>$program]);
       

        if (!$program) {
            throw $this->createNotFoundException("Aucun programme trouvé avec l'id $id");
        }

        return $this->render('/program/show.html.twig', [
            'program' => $program,
            'id' =>$id,
            'seasons' =>$seasons
        ]);
    }

    #[Route('/program/{id<^\d+$>}/seasons', name: 'app_seasons_show', methods:['GET'])]
    public function showSeasons(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->find($programId);
        $season = $seasonRepository->find($seasonId);
       

        if (!$season) {
            throw $this->createNotFoundException("Aucun programme trouvé avec l'id $seasonId");
        }

        return $this->render('/program/show.html.twig', [
            'program' => $program,
            'programId' =>$programId,
            'seasonId' => $seasonId
        ]);
    }
    
}


// AFFICHAGE DES SAISONS EN COURS !!!!!!!!!!!