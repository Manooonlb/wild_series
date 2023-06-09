<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name:'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render(
            'program/index.html.twig', 
            ['programs' => $programs]
        );
    }

    #[Route('/{id<\d+>}', methods:['GET'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneById($id);

        if (!$program){
            throw $this->createNotFoundException(
                "Il n'y a pas de série avec l'identifiant : $id 😭"
            );
        }
        return $this->render('program/show.html.twig', [
            'program'=>$program,
        ]);
    }

    #[Route('/{program<\d+>}/seasons/{id<\d+>}', methods:['GET'], name: 'season_show')]
    public function showSeason(Program $program, Season $season): Response
    {
        return $this->render('season/show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }
    
}