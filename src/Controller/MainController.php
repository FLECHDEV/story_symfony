<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Story;
use App\Form\StoryType;
use App\Form\RegistrationFormType;
use App\Repository\StoryRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function mainAction(
        StoryRepository $storyRepository,
    ): Response {

        $user = $this->getUser();
        // Get all stories

        $stories = $storyRepository->findStoriesByUser($user);
        $user = new User();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);


        // return twig rendering page
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'stories' => $stories,
            'registrationForm' => $registrationForm,
        ]);
    }
}
