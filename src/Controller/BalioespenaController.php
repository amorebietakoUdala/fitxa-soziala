<?php

namespace App\Controller;

use App\Entity\Balioespena;
use App\Form\BalioespenaType;
use App\Repository\BalioespenaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/balioespena')]
class BalioespenaController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly BalioespenaRepository $balioespenaRepository
    )
    {
    }
    #[Route(path: '/', name: 'balioespena_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('balioespena/index.html.twig', [
            'balioespenas' => $this->balioespenaRepository->treeList(),
            //'balioespenas' => $this->balioespenaRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'balioespena_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $balioespena = new Balioespena();
        $form = $this->createForm(BalioespenaType::class, $balioespena);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($balioespena);
            $this->entityManager->flush();

            return $this->redirectToRoute('balioespena_index');
        }

        return $this->render('balioespena/new.html.twig', [
            'balioespena' => $balioespena,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'balioespena_show', methods: ['GET'])]
    public function show(#[MapEntity(id: 'id')] Balioespena $balioespena): Response
    {
        return $this->render('balioespena/show.html.twig', [
            'balioespena' => $balioespena,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'balioespena_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Balioespena $balioespena): Response
    {
        $form = $this->createForm(BalioespenaType::class, $balioespena);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('balioespena_index');
        }

        return $this->render('balioespena/edit.html.twig', [
            'balioespena' => $balioespena,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'balioespena_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Balioespena $balioespena): Response
    {
        if ($this->isCsrfTokenValid('delete'.$balioespena->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($balioespena);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('balioespena_index');
    }
}
