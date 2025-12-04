<?php

namespace App\Controller;

use App\Entity\Errolda;
use App\Form\ErroldaType;
use App\Repository\ErroldaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/errolda')]
class ErroldaController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ErroldaRepository $erroldaRepository
    )
    {
    }
    #[Route(path: '/', name: 'errolda_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('errolda/index.html.twig', [
            //'erroldas' => $erroldaRepository->findAll(),
            'erroldas' => $this->erroldaRepository->treeList(),
        ]);
    }

    #[Route(path: '/new', name: 'errolda_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $errolda = new Errolda();
        $form = $this->createForm(ErroldaType::class, $errolda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($errolda);
            $this->entityManager->flush();

            return $this->redirectToRoute('errolda_index');
        }

        return $this->render('errolda/new.html.twig', [
            'errolda' => $errolda,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'errolda_show', methods: ['GET'])]
    public function show(#[MapEntity(id: 'id')] Errolda $errolda): Response
    {
        return $this->render('errolda/show.html.twig', [
            'errolda' => $errolda,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'errolda_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Errolda $errolda): Response
    {
        $form = $this->createForm(ErroldaType::class, $errolda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('errolda_index');
        }

        return $this->render('errolda/edit.html.twig', [
            'errolda' => $errolda,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'errolda_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Errolda $errolda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$errolda->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($errolda);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('errolda_index');
    }
}
