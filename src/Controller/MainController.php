<?php

namespace App\Controller;

use Exception;
use App\Entity\User;
use App\Entity\Story;
use App\Form\StoryType;
use App\Form\RegistrationFormType;
use App\Repository\StoryRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    #[Route('/{id}', name: 'app_main')]
    public function mainAction(
        StoryRepository $storyRepository,
        $id = null,
    ): Response {

        $user = $this->getUser();
        // Get all stories

        $stories = $storyRepository->findStoriesByUser($user);
        if ($id) {
            $selectedStory = $storyRepository->findOneBy(['id' => $id]);
            if (!$selectedStory) {
                throw new Exception('No story found for id' . $id, 404);
            }
        } else {
            $selectedStory = $stories[0];
        }

        $user = new User();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);

        // return twig rendering page
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'stories' => $stories,
            'selectedStory'  => $selectedStory,
            'registrationForm' => $registrationForm,
        ]);
    }
}
