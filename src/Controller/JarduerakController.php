<?php

namespace App\Controller;

use App\Entity\Jarduerak;
use App\Form\JarduerakType;
use App\Repository\JarduerakRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/jarduerak')]
class JarduerakController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly JarduerakRepository $jarduerakRepository
    )
    {
    }
    #[Route(path: '/', name: 'jarduerak_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('jarduerak/index.html.twig', [
            //'jardueraks' => $jarduerakRepository->findAll(),
            'jardueraks' => $this->jarduerakRepository->treeList(),
        ]);
    }

    #[Route(path: '/new', name: 'jarduerak_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $jarduerak = new Jarduerak();
        $form = $this->createForm(JarduerakType::class, $jarduerak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($jarduerak);
            $this->entityManager->flush();

            return $this->redirectToRoute('jarduerak_index');
        }

        return $this->render('jarduerak/new.html.twig', [
            'jarduerak' => $jarduerak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'jarduerak_show', methods: ['GET'])]
    public function show(#[MapEntity(id: 'id')] Jarduerak $jarduerak): Response
    {
        return $this->render('jarduerak/show.html.twig', [
            'jarduerak' => $jarduerak,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'jarduerak_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Jarduerak $jarduerak): Response
    {
        $form = $this->createForm(JarduerakType::class, $jarduerak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('jarduerak_index');
        }

        return $this->render('jarduerak/edit.html.twig', [
            'jarduerak' => $jarduerak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'jarduerak_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Jarduerak $jarduerak): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jarduerak->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($jarduerak);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('jarduerak_index');
    }
}
