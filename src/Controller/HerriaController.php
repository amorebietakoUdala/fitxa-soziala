<?php

namespace App\Controller;

use App\Entity\Herria;
use App\Form\HerriaType;
use App\Repository\HerriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/herria')]
class HerriaController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly HerriaRepository $herriaRepository
    )
    {
    }
    #[Route(path: '/', name: 'herria_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('herria/index.html.twig', [
            'herrias' => $this->herriaRepository->findAll(),
        ]);
    }
    
    #[Route(path: '/new', name: 'herria_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $herrium = new Herria();
        $form = $this->createForm(HerriaType::class, $herrium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($herrium);
            $this->entityManager->flush();

            return $this->redirectToRoute('herria_index');
        }

        return $this->render('herria/new.html.twig', [
            'herrium' => $herrium,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'herria_show', methods: ['GET'])]
    public function show(#[MapEntity(id: 'id')] Herria $herrium): Response
    {
        return $this->render('herria/show.html.twig', [
            'herrium' => $herrium,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'herria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Herria $herrium): Response
    {
        $form = $this->createForm(HerriaType::class, $herrium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('herria_index');
        }

        return $this->render('herria/edit.html.twig', [
            'herrium' => $herrium,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'herria_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Herria $herrium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$herrium->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($herrium);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('herria_index');
    }
}
