<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/story')]
class StoryController extends AbstractController
{

    #[Route('/new', name: 'app_story_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StoryRepository $storyRepository): Response
    {
        $story = new Story();
        $form = $this->createForm(StoryType::class, $story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $storyRepository->save($story, true);

            $this->addFlash("success", "Nouvelle storiz créée");
            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('story/new.html.twig', [
            'story' => $story,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}/edit', name: 'app_story_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Story $story, StoryRepository $storyRepository): Response
    {
        $form = $this->createForm(StoryType::class, $story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $storyRepository->save($story, true);
            
            $this->addFlash("success", "Storiz modifiée");
            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('story/edit.html.twig', [
            'story' => $story,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_story_delete', methods: ['POST'])]
    public function delete(Request $request, Story $story, StoryRepository $storyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $story->getId(), $request->request->get('_token'))) {
            $storyRepository->remove($story, true);
        }
        $this->addFlash("success", "Storiz supprimée");
        return $this->redirectToRoute('app_main');
    }
}
