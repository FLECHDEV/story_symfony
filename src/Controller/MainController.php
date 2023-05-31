<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    #[Route('/', name: 'main')]
    public function allStories(StoryRepository $storyRepository): Response
    {
        // Get all stories
        $stories = $storyRepository->findAll();
        // Get return twig rendering page
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'stories' => $stories,
        ]);
    }
    
    public function newStory(Request $request, EntityManagerInterface $entityManager): Response
{
    $newStory = new Story();
    $storyForm = $this->createForm(StoryType::class, $newStory);
    $storyForm->handleRequest($request);

    if ($storyForm->isSubmitted() && $storyForm->isValid()) {
        $entityManager->persist($newStory);
        $entityManager->flush();
        return $this->redirectToRoute('main');
    }
}
}

