<?php

namespace App\Controller;

use App\Entity\ArtBoard;
use App\Form\ArtBoardType;
use App\Repository\ArtBoardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/artboard')]
class ArtBoardController extends AbstractController
{
    #[Route('/', name: 'app_art_board_index', methods: ['GET'])]
    public function index(ArtBoardRepository $artBoardRepository): Response
    {
        return $this->render('art_board/index.html.twig', [
            'art_boards' => $artBoardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_art_board_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $artBoard = new ArtBoard();
        $form = $this->createForm(ArtBoardType::class, $artBoard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($artBoard);
            $entityManager->flush();

            return $this->redirectToRoute('app_art_board_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('art_board/new.html.twig', [
            'art_board' => $artBoard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_art_board_show', methods: ['GET'])]
    public function show(ArtBoard $artBoard): Response
    {
        return $this->render('art_board/show.html.twig', [
            'art_board' => $artBoard,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_art_board_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArtBoard $artBoard, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArtBoardType::class, $artBoard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_art_board_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('art_board/edit.html.twig', [
            'art_board' => $artBoard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_art_board_delete', methods: ['POST'])]
    public function delete(Request $request, ArtBoard $artBoard, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artBoard->getId(), $request->request->get('_token'))) {
            $entityManager->remove($artBoard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_art_board_index', [], Response::HTTP_SEE_OTHER);
    }
}
