<?php

namespace App\Controller;

use App\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'main')]
    public function index(StoryRepository $storyRepository): Response
    {
        // Get all stories
        $stories = $storyRepository->findAll();
        // Get return twig rendering page
        return $this->render('main/index.html.twig', [
            // 'controller_name' => 'MainController',
            // 'stories' => $stories,
        ]);
    }
}