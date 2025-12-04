<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Form\GeneroType;
use App\Repository\GeneroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/genero')]
class GeneroController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly GeneroRepository $generoRepository,
    )
    {
    }
    #[Route(path: '/', name: 'genero_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('genero/index.html.twig', [
            'generos' => $this->generoRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'genero_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $genero = new Genero();
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($genero);
            $this->entityManager->flush();

            return $this->redirectToRoute('genero_index');
        }

        return $this->render('genero/new.html.twig', [
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'genero_show', methods: ['GET'])]
    public function show(#[MapEntity(id: 'id')] Genero $genero): Response
    {
        return $this->render('genero/show.html.twig', [
            'genero' => $genero,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'genero_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Genero $genero): Response
    {
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('genero_index');
        }

        return $this->render('genero/edit.html.twig', [
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'genero_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Genero $genero): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genero->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($genero);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('genero_index');
    }
}
