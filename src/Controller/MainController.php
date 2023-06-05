<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use App\Repository\ChapterRepository;
use App\Repository\CharacterRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function mainAction(
        StoryRepository $storyRepository,
        CharacterRepository $characterRepository,
        ChapterRepository $chapterRepository
    ): Response {
        // Get all stories
        $stories = $storyRepository->findAll();
        // get all chapters
        $chapters = $chapterRepository->findAll();
        // get all characters
        $characters = $characterRepository->findAll();
        // Get return twig rendering page
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'stories' => $stories,
            'chapters' => $chapters,
            'characters' => $characters
        ]);
    }
}
