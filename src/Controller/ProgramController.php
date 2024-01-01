<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\CategoryRepository;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program', name: 'app_program')]
    public function index(ProgramRepository $programRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $programs = $paginator->paginate(
            $programRepository->createQueryBuilder('p'),
            $request->query->getInt('page', 1),
            2
        );

        $latestProgram = $programRepository->findOneBy([], ['createdAt' => 'DESC']);



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
            'id' => $id,
            'seasons' => $seasons
        ]);
    }

    #[Route('/program/{programId<^\d+$>}/season/{seasonId<^\d+$>}', name: 'app_season_show', methods:['GET'])]
    public function showSeasons(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
    {
        $program = $programRepository->find($programId);
        $season = $seasonRepository->find($seasonId);
        $seasons = $seasonRepository->findby(['program'=>$program]);
        $episodes = $episodeRepository->findby(['season' => $season]);
       

        if (!$season) {
            throw $this->createNotFoundException("Aucun programme trouvé avec l'id $seasonId");
        }

        return $this->render('/program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'seasons' => $seasons,
            'episodes' => $episodes
            
        ]);
    }
    

    #[Route('/program/new', name: 'app_program_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $program = new Program(); //Je créé un nouvel objet Programme
        $form = $this->createForm (ProgramType::class, $program); // ProgramController créé un nouveau formulaire qui se réfère à l'entité Programme
        $form->handleRequest($request); // Le formulaire récupère les données avec la requête http

        if ($form->isSubmitted()&& $form->isValid()) {

            // si le formulaire est soumis et validé, l'entity manager persite les données et les flush (intègre dans la bdd)

            $em->persist($form->getData());
            $em->flush();
            //puis ProgrammController renvoie une redirection vers la page programmes
            return $this->redirectToRoute('app_program');
        }
        // rend le formulaire sur la vue '/program/program_new.html.twig'
        return $this->render('/program/program_new.html.twig', [
            'form' => $form
        ]);
        
    }


//     #[Route('/program/edit', name: 'app_program_edit')]
//     public function edit(Request $request, EntityManagerInterface $em, ProgramRepository $programRepository): Response
//     {
//         $form = $this->createForm (ProgramType::class, $program); // ProgramController créé un nouveau formulaire qui se réfère à l'entité Programme
//         $form->handleRequest($request); // Le formulaire récupère les données avec la requête http

//         if ($form->isSubmitted()&& $form->isValid()) {

//             // si le formulaire est soumis et validé, l'entity manager flush (update dans la bdd)
//             $em->flush();
//             //puis ProgrammController renvoie une redirection vers la page programmes
//             return $this->redirectToRoute('app_program');
//         }
//         // rend le formulaire sur la vue '/program/program_new.html.twig'
//         return $this->render('/program/program_new.html.twig', [
//             'form' => $form
//         ]);
// }


}