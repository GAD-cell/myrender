<?php

namespace App\Controller;
use App\Entity\Album;
use App\Form\AlbumType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


#[Route('/album')]
class AlbumController extends AbstractController
{
    #[Route('/', name: 'album')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager= $doctrine->getManager();
        $album = $entityManager->getRepository(Album::class)->findAll();    
        return $this->render('Album/index.html.twig', [
            'controller_name' => 'RendusController',
            'albums'=> $album
        ]);
    }
    #[Route('/new', name: 'new_album', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('album', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Album/new.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'edit_album', methods: ['GET', 'POST'])]
    public function edit(Request $request, Album $album, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('album', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Album/edit.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'delete_album', methods: ['POST'])]
    public function delete(Request $request, Album $album, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            $entityManager->remove($album);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paste_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}', name: 'album_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showAction(Album $album): Response
    {
    return $this->render('Album/show.html.twig',
        [ 'albums' => $album ]

    );
    }
}
