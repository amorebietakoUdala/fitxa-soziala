<?php

namespace App\Controller;

use App\Entity\Estatuak;
use App\Form\EstatuakType;
use App\Repository\EstatuakRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/estatuak')]
class EstatuakController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly EstatuakRepository $estatuakRepository
    )
    {
    }
    #[Route(path: '/', name: 'estatuak_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('estatuak/index.html.twig', [
            'estatuaks' => $this->estatuakRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'estatuak_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $estatuak = new Estatuak();
        $form = $this->createForm(EstatuakType::class, $estatuak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($estatuak);
            $this->entityManager->flush();

            return $this->redirectToRoute('estatuak_index');
        }

        return $this->render('estatuak/new.html.twig', [
            'estatuak' => $estatuak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'estatuak_show', methods: ['GET'])]
    public function show(#[MapEntity(id: 'id')] Estatuak $estatuak): Response
    {
        return $this->render('estatuak/show.html.twig', [
            'estatuak' => $estatuak,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'estatuak_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Estatuak $estatuak): Response
    {
        $form = $this->createForm(EstatuakType::class, $estatuak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('estatuak_index');
        }

        return $this->render('estatuak/edit.html.twig', [
            'estatuak' => $estatuak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'estatuak_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Estatuak $estatuak): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estatuak->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($estatuak);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('estatuak_index');
    }
}
