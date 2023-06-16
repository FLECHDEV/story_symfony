<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

#[Route('/api')]
class ApiController extends AbstractController
{

    #[Route('/createStory')]
    public function newStory(Request $request, EntityManagerInterface $entityManager): Response
    {
        $newStory = new Story();
        $storyName = $request->request->get('newStory');
        $newStory->setName($storyName);

        $user = $this->getUser();
        $newStory->setUser($user);

        $entityManager->persist($newStory);
        $entityManager->flush();
        // return new JsonResponse('ok');
        return $this->redirectToRoute('app_main');
    }

    #[Route('/story/{story}')]
    public function getStory(Request $request, Story $story, EntityManagerInterface $entityManager): JsonResponse
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);
        $storyJson = $serializer->normalize($story, 'json', ['groups' => 'story']);
        return new JsonResponse($storyJson);
    }

    #[Route('/chapter/{id}', methods: ['POST'])]
    public function updateChapterContent(Request $request, string $id, EntityManagerInterface $entityManager)
    {
        $chapterContent = $request->request->get('chapterContent');
        $chapter = $entityManager->getRepository(Chapter::class)->find($id);
        $chapter->setIdeas($chapterContent);
        $entityManager->flush();

        return new JsonResponse('ok');
    }
}
