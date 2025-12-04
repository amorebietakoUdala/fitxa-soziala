<?php

namespace App\Controller;

use App\Entity\Arrazoia;
use App\Form\ArrazoiaType;
use App\Repository\ArrazoiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/arrazoia')]
class ArrazoiaController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ArrazoiaRepository $arrazoiaRepository
    )
    {
    }
    
    #[Route(path: '/', name: 'arrazoia_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $locale = $request->getLocale();
        
        return $this->render('arrazoia/index.html.twig', [
            //'arrazoias' => $this->arrazoiaRepository->findAll(),
            'arrazoias' => $this->arrazoiaRepository->treeList(),
            
        ]);
    }

    #[Route(path: '/new', name: 'arrazoia_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $arrazoia = new Arrazoia();
        $form = $this->createForm(ArrazoiaType::class, $arrazoia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($arrazoia);
            $this->entityManager->flush();

            return $this->redirectToRoute('arrazoia_index');
        }

        return $this->render('arrazoia/new.html.twig', [
            'arrazoia' => $arrazoia,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'arrazoia_show', methods: ['GET'])]
    public function show(#[MapEntity(id: 'id')] Arrazoia $arrazoia): Response
    {
        return $this->render('arrazoia/show.html.twig', [
            'arrazoia' => $arrazoia,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'arrazoia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Arrazoia $arrazoia): Response
    {
        $form = $this->createForm(ArrazoiaType::class, $arrazoia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('arrazoia_index');
        }

        return $this->render('arrazoia/edit.html.twig', [
            'arrazoia' => $arrazoia,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'arrazoia_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Arrazoia $arrazoia): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arrazoia->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($arrazoia);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('arrazoia_index');
    }
}
