<?php

namespace App\Controller;

use App\Entity\Estatuak;
use App\Form\EstatuakType;
use App\Repository\EstatuakRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/estatuak')]
class EstatuakController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    #[Route(path: '/', name: 'estatuak_index', methods: ['GET'])]
    public function index(EstatuakRepository $estatuakRepository): Response
    {
        return $this->render('estatuak/index.html.twig', [
            'estatuaks' => $estatuakRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'estatuak_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $estatuak = new Estatuak();
        $form = $this->createForm(EstatuakType::class, $estatuak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($estatuak);
            $entityManager->flush();

            return $this->redirectToRoute('estatuak_index');
        }

        return $this->render('estatuak/new.html.twig', [
            'estatuak' => $estatuak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'estatuak_show', methods: ['GET'])]
    public function show(Estatuak $estatuak): Response
    {
        return $this->render('estatuak/show.html.twig', [
            'estatuak' => $estatuak,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'estatuak_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Estatuak $estatuak): Response
    {
        $form = $this->createForm(EstatuakType::class, $estatuak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('estatuak_index');
        }

        return $this->render('estatuak/edit.html.twig', [
            'estatuak' => $estatuak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'estatuak_delete', methods: ['POST'])]
    public function delete(Request $request, Estatuak $estatuak): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estatuak->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($estatuak);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estatuak_index');
    }
}
