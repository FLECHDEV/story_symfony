<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Form\ChapterType;
use App\Repository\ChapterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chapter')]
class ChapterController extends AbstractController
{
    #[Route('/', name: 'app_chapter_index', methods: ['GET'])]
    public function index(ChapterRepository $chapterRepository): Response
    {
        return $this->render('chapter/index.html.twig', [
            'chapters' => $chapterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_chapter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChapterRepository $chapterRepository): Response
    {
        $chapter = new Chapter();
        $form = $this->createForm(ChapterType::class, $chapter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapterRepository->save($chapter, true);

            return $this->redirectToRoute('app_chapter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chapter/new.html.twig', [
            'chapter' => $chapter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chapter_show', methods: ['GET'])]
    public function show(Chapter $chapter): Response
    {
        return $this->render('chapter/show.html.twig', [
            'chapter' => $chapter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chapter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chapter $chapter, ChapterRepository $chapterRepository): Response
    {
        $form = $this->createForm(ChapterType::class, $chapter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapterRepository->save($chapter, true);

            return $this->redirectToRoute('app_chapter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chapter/edit.html.twig', [
            'chapter' => $chapter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chapter_delete', methods: ['POST'])]
    public function delete(Request $request, Chapter $chapter, ChapterRepository $chapterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $chapter->getId(), $request->request->get('_token'))) {
            $chapterRepository->remove($chapter, true);
        }

        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/get_chapter_details", name="get_chapter_details", methods={"POST"})
     */
    public function getChapterDetails(Request $request, ChapterRepository $chapterRepository): Response
    {
        $chapterId = $request->request->get('chapterId');

        // Récupérer les détails du chapitre en fonction de l'ID
        $chapter = $chapterRepository->find($chapterId);

        // Vérifier si le chapitre existe
        if (!$chapter) {
            throw $this->createNotFoundException('Chapitre non trouvé');
        }

        // Retourner les détails du chapitre sous forme de réponse JSON
        return $this->json([
            'currentChapter' => $chapter->getChapterName(),
            // ...
        ]);
    }

    // ...
}

