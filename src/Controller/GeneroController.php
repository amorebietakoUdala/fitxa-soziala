<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Form\GeneroType;
use App\Repository\GeneroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/genero')]
class GeneroController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    #[Route(path: '/', name: 'genero_index', methods: ['GET'])]
    public function index(GeneroRepository $generoRepository): Response
    {
        return $this->render('genero/index.html.twig', [
            'generos' => $generoRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'genero_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $genero = new Genero();
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($genero);
            $entityManager->flush();

            return $this->redirectToRoute('genero_index');
        }

        return $this->render('genero/new.html.twig', [
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'genero_show', methods: ['GET'])]
    public function show(Genero $genero): Response
    {
        return $this->render('genero/show.html.twig', [
            'genero' => $genero,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'genero_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Genero $genero): Response
    {
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('genero_index');
        }

        return $this->render('genero/edit.html.twig', [
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'genero_delete', methods: ['POST'])]
    public function delete(Request $request, Genero $genero): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genero->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($genero);
            $entityManager->flush();
        }

        return $this->redirectToRoute('genero_index');
    }
}
