<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class ApiController extends AbstractController
{

    #[Route('/createStory')]
    public function newStory(Request $request, EntityManagerInterface $entityManager): Response
    {
        $newStory = new Story();
        $storyName = $request->request->get('newStory');
        $newStory->setStoryName($storyName);

        $user = $this->getUser();
        $newStory->setUserId($user);

        $entityManager->persist($newStory);
        $entityManager->flush();
        // return new JsonResponse('ok');
        return $this->redirectToRoute('app_main');
    }
}
