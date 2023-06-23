<?php

namespace App\Controller;

use Exception;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\StoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{


    #[Route('/')]
    public function welcomeAction(): Response
    {

        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        return $this->redirectToRoute('app_main');
    }


    #[Route('/main/{id}', name: 'app_main')]
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
            $selectedStory = $stories[0] ?? null;
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
